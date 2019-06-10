<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");

use CareerBusters\WebDevJobs\{Profile, Posting};

/**
 * api for the Posting class
 *
 * @author  <youngblkraven@gmail.com>
 **/

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/busters.ini");
	$pdo = $secrets->getPdoObject();

	//determine which HTTP method was used
//	$_SESSION["profile"] = Profile::getProfileByProfileId($pdo, $id);
//	$_SESSION["profile"] = Profile::getProfileByProfileId($pdo, "35246e2b-926d-410d-bc88-719d09a809c5");

	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$postingProfileId = filter_input(INPUT_GET, "postingProfileId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$postingRoleId = filter_input(INPUT_GET, "postingRoleId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$postingCompanyName = filter_input(INPUT_GET, "postingCompanyName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$postingContent = filter_input(INPUT_GET, "postingContent", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$postingDate = filter_input(INPUT_GET, "postingDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$postingEmail = filter_input(INPUT_GET, "postingEmail", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$postingEndDate = filter_input(INPUT_GET, "postingEndDate", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$postingLocation = filter_input(INPUT_GET, "postingLocation", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$postingPay = filter_input(INPUT_GET, "postingPay", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$postingTitle = filter_input(INPUT_GET, "postingTitle", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && empty($id) === true) {
		throw(new InvalidArgumentException("id cannot be empty", 405));
	}

	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific posting based on arguments provided or all the postings and update reply
//gets a post by id
		if(empty($id) === false) {
			$reply->data = Posting::getPostingByPostingId($pdo, $id);
		} else if(empty($postingProfileId) === false) {
			$reply->data = Posting::getPostingByPostingProfileId($pdo, $postingProfileId);
		} else if(empty($postingRoleId) === false) {
			$reply->data = Posting::getPostingByPostingRoleId($pdo, $postingRoleId);
		} else {
			$reply->data = Posting::getAllPostings($pdo)->toArray();
		}


		//perform the actual put or post
	} else if($method === "PUT") {

		$requestContent = file_get_contents("php://input");
		// Retrieves the JSON package that the front end sent, and stores it in $requestContent. Here we are using file_get_contents("php://input") to get the request from the front end. file_get_contents() is a PHP function that reads a file into a string. The argument for the function, here, is "php://input". This is a read only stream that allows raw data to be read from the front end request which is, in this case, a JSON package.
		$requestObject = json_decode($requestContent);
		// This Line Then decodes the JSON package and stores that result in $requestObject

		//profile as handle
		if(empty($requestObject->profileId) === true) {
			throw(new \InvalidArgumentException ("No profile on file", 405));
		}
		if(empty($requestObject->roleId) === true) {
			throw(new \InvalidArgumentException ("you must enter a role Id", 405));
		}
		//profile content is a required field
		if(empty($requestObject->postingContent) === true) {
			throw(new \InvalidArgumentException("content is empty", 405));
		}
		//job posting date
		if(empty($requestObject->postingDate) === true) {
			throw(new \InvalidArgumentException("posting date wasn't current", 405));
		}
		//check profile email is a required field
		if(empty($requestObject->postingEmail) === true) {
			throw(new \InvalidArgumentException("No email is present", 405));
		}
		//job posting end date
		if(empty($requestObject->postingEndDate) === true) {
			throw(new \InvalidArgumentException("requires a end date for job posting", 405));
		}
		//verify that profile password is present
		if(empty($requestObject->postingCompanyName) === true) {
			throw(new \InvalidArgumentException("please put your company name", 405));
		}
//verify that profile password is present
		if(empty($requestObject->postingLocation) === true) {
			throw(new \InvalidArgumentException("Location must be Albuquerque", 405));
		}
		//verify that profile password is present
		if(empty($requestObject->postingTitle) === true) {
			throw(new \InvalidArgumentException("title is required", 405));
		}
//verify that profile password is present
		if(empty($requestObject->postingPay) === true) {
			throw(new \InvalidArgumentException("Must input the amount the job pays", 405));
		}
		// update reply
		$reply->message = "job posting OK";

	} else if($method === "POST") {

		$requestContent = file_get_contents("php://input");
		// Retrieves the JSON package that the front end sent, and stores it in $requestContent. Here we are using file_get_contents("php://input") to get the request from the front end. file_get_contents() is a PHP function that reads a file into a string. The argument for the function, here, is "php://input". This is a read only stream that allows raw data to be read from the front end request which is, in this case, a JSON package.
		$requestObject = json_decode($requestContent);
		// This Line Then decodes the JSON package and stores that result in $requestObject
		// profile object needs to be created and prepare to insert into the database
		$posting = new Posting(generateUuidV4(), $_SESSION["profile"]->getProfileId(), $requestObject->postingRoleId, $requestObject->postingContent, $requestObject->postingDate, $requestObject->postingEmail, $requestObject->postingEndDate, $requestObject->postingCompanyName, $requestObject->postingLocation, $requestObject->postingTitle, $requestObject->postingPay);
		//insert the profile into the database
		$posting->insert($pdo);

		// update reply
		$reply->message = "job posted created";

	}
} catch(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
// encode and return reply to front end caller
header("Content-type: application/json");
echo json_encode($reply);


