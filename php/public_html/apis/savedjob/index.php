<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";

use CareerBusters\WebDevJobs\SavedJob;

/**
 * Api for the Saved Job class
 *
 * @author nlovato
 */
//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/busters.ini");
	$pdo = $secrets->getPdoObject();

	//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

	//sanitize the search parameters
	$savedJobPostingId = $id = filter_input(INPUT_GET, "savedJobPostingId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$savedJobProfileId = $id = filter_input(INPUT_GET, "savedJobProfileId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//gets a specific saved job associated based on its composite key
		if($savedJobPostingId !== null && $savedJobProfileId !== null) {
			$savedJob = SavedJob::getSavedJobBySavedJobPostingIdAndSavedJobProfileId($pdo, $savedJobPostingId, $savedJobProfileId);

			if($savedJob !== null) {
				$reply->data = $savedJob;
			}
			//if none of the search parameters are met throw an exception
		} else if(empty($savedJobPostingId) === false) {
			$reply->data = SavedJob::getSavedJobBySavedJobPostingId($pdo, $savedJobPostingId)->toArray();
			//get all the saved jobs associated with the savedJobProfileId
		} else if(empty($savedJobProfileId) === false) {
			$reply->data = SavedJob::getSavedJobBySavedJobProfileId($pdo, $savedJobProfileId)->toArray();
		} else {
			throw new InvalidArgumentException("incorrect search parameters ", 404);
		}

	} else if($method === "POST") {
		//decode the response from the front end
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		if(empty($requestObject->savedJobPostingId) === true) {
			throw (new \InvalidArgumentException("No Posting Id linked to the saved job", 405));
		}

		if(empty($requestObject->savedJobProfileId) === true) {
			throw (new \InvalidArgumentException("No Profile linked to the saved job", 405));
		}

		if($method === "POST") {
			//enforce that the end user has a XSRF token.
			verifyXsrf();

			//enforce the end user has a JWT token
			//validateJwtHeader();

			// enforce the user is signed in
			if(empty($_SESSION["profile"]) === true) {
				throw(new \InvalidArgumentException("you must be logged in too save job", 403));
			}
			validateJwtHeader();

			$savedJob = new SavedJob($_SESSION["profile"]->getProfileId(), $requestObject->savedJobProfileId);
			$savedJob->insert($pdo);
			$reply->message = "saved job successful";

//enforce the user is signed in and only trying to edit their own saved job
			if(empty($_SESSION["profile"]) === true || $_SESSION["profile"]->getProfileId() !== $savedJob->getSavedJobPostingId()) {
				throw(new \InvalidArgumentException("You are not allowed to delete this saved job", 403));
			}
			//validateJwtHeader();

			//preform the actual delete
			$savedJob->delete($pdo);

			//update the message
			$reply->message = "Saved job successfully deleted";
		}

		// if any other HTTP request is sent throw an exception
	} else {
		throw new \InvalidArgumentException("invalid http request", 400);
	}
	//catch any exceptions that is thrown and update the reply status and message
} catch(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
// encode and return reply to front end caller
echo json_encode($reply);

