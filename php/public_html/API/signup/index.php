<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/php/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");

use Edu\Cnm\DataDesign\{
	// we only use the profile class for testing purposes
	Profile
};


/**
 * api for the Tweet class
 *
 * @author {} <valebmeza@gmail.com>
 * @coauthor Derek Mauldin <derek.e.mauldin@gmail.com>
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
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/ddctwitter.ini");


	//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$tweetProfileId = filter_input(INPUT_GET, "tweetProfileId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$tweetContent = filter_input(INPUT_GET, "tweetContent", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
else if($method === "POST") {

	// enforce the user has a XSRF token
	verifyXsrf();

	//  Retrieves the JSON package that the front end sent, and stores it in $requestContent. Here we are using file_get_contents("php://input") to get the request from the front end. file_get_contents() is a PHP function that reads a file into a string. The argument for the function, here, is "php://input". This is a read only stream that allows raw data to be read from the front end request which is, in this case, a JSON package.
	$requestContent = file_get_contents("php://input");

	// This Line Then decodes the JSON package and stores that result in $requestObject
	$requestObject = json_decode($requestContent);

	// make sure tweet date is accurate (optional field)
	if(empty($requestObject->profileDate) === true) {
		$requestObject->profileDate = null;
	} else {
		// if the date exists, Angular's milliseconds since the beginning of time MUST be converted
		$profileDate = DateTime::createFromFormat("U.u", $requestObject->profileDate / 1000);
		if($profileDate === false) {
			throw(new RuntimeException("invalid profile date", 400));
		}
		$requestObject->profileDate = $profileDate;
	}}
else if($method === "POST") {

	// enforce the user is signed in
	if(empty($_SESSION["profile"]) === true) {
		throw(new \InvalidArgumentException("you must be logged in to create a profile", 403));
	}

	// create new profile and insert into the database
	$profile = new Profile(generateUuidV4(), $_SESSION["profile"]->getProfileId, null);
	$profile->insert($pdo);

	// update reply
	$reply->message = "profile created OK";
}
}