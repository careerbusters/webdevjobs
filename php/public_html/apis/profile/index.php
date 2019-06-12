<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
use CareerBusters\WebDevJobs\Profile;
/**
 * apis for Profile
 *
 *
 * @author Gkephart
 * @author  tgray19
 * @version 1.0
 */
//verify the session, if it is not active start it
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
	//verify the session, if it is not active start it
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();}
	//grab the mySQL connection
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/busters.ini");
	$pdo = $secrets->getPdoObject();
	//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];
	// sanitize input
	$profileId = filter_input(INPUT_GET, "profileId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$profileRoleId = filter_input(INPUT_GET, "profileRoleId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$profileEmail = filter_input(INPUT_GET, "profileEmail", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$profileUsername = filter_input(INPUT_GET, "profileUsername", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	// make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($profileId) === true)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);
		//gets a profile by content
		if(empty($profileId) === false) {
			$reply->data = Profile::getProfileByProfileId($pdo, $profileId);
		} else if(empty($profileRoleId) === false) {
			$reply->data = Profile::getProfileByProfileRoleId($pdo, $profileRoleId)->toArray();
		} else if(empty($profileEmail) === false) {
			$reply->data = Profile::getProfileByProfileEmail($pdo, $profileEmail);
		} else if(empty($profileUsername) === false) {
			$reply->data = Profile::getProfileByProfileUsername($pdo, $profileUsername);
		}
	} elseif($method === "PUT") {
		//enforce that the XSRF token is present in the header
		verifyXsrf();
		//enforce the end user has a JWT token
		validateJwtHeader();
		//enforce the user is signed in and only trying to edit their own profile
		if(empty($_SESSION["profile"]) === true || $_SESSION["profile"]->getProfileId()->toString() !== $profileId) {
			throw(new \InvalidArgumentException("You are not allowed to access this profile", 403));
		}
//		validateJwtHeader();
		//decode the response from the front end
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);
		//retrieve the profile to be updated
		$profile = Profile::getProfileByProfileId($pdo, $profileId);
		if($profile === null) {
			throw(new RuntimeException("Profile does not exist", 404));
		}
		//profileRoleId
		if(empty($requestObject->profileRoleId) === true) {
			throw(new \InvalidArgumentException ("No profileRoleId", 405));
		}
		//profile email is a required field
		if(empty($requestObject->profileEmail) === true) {
			throw(new \InvalidArgumentException ("No profile email present", 405));
		}
		//profileUsername
		if(empty($requestObject->profileUsername) === true) {
			throw(new \InvalidArgumentException ("No profileUsername", 405));
		}
		// Do i include id here too?
		$profile->setProfileRoleId($requestObject->profileRoleId);
		$profile->setProfileEmail($requestObject->profileEmail);
		$profile->setProfileUsername($requestObject->profileUsername);
		$profile->update($pdo);
		// update reply
		$reply->message = "Profile information updated";
	}
	// catch any exceptions that were thrown and update the status and message state variable fields
} catch
(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
// encode and return reply to front end caller
echo json_encode($reply);