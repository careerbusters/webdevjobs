<?php
else if($method === "PUT" || $method === "POST") {

	// enforce the user has a XSRF token
	verifyXsrf();

	//  Retrieves the JSON package that the front end sent, and stores it in $requestContent. Here we are using file_get_contents("php://input") to get the request from the front end. file_get_contents() is a PHP function that reads a file into a string. The argument for the function, here, is "php://input". This is a read only stream that allows raw data to be read from the front end request which is, in this case, a JSON package.
	$requestContent = file_get_contents("php://input");

	// This Line Then decodes the JSON package and stores that result in $requestObject
	$requestObject = json_decode($requestContent);

	//make sure tweet content is available (required field)
	if(empty($requestObject->tweetContent) === true) {
		throw(new \InvalidArgumentException ("No content for Tweet.", 405));
	}

	// make sure tweet date is accurate (optional field)
	if(empty($requestObject->profileDate) === true) {
		$requestObject->profileDate = null;
	} else {
		// if the date exists, Angular's milliseconds since the beginning of time MUST be converted
		$tweetDate = DateTime::createFromFormat("U.u", $requestObject->profileDate / 1000);
		if($profileDate === false) {
			throw(new RuntimeException("invalid profile date", 400));
		}
		$requestObject->profileDate = $profileDate;
	}}
else if($method === "POST") {

	// enforce the user is signed in
	if(empty($_SESSION["profile"]) === true) {
		throw(new \InvalidArgumentException("you must be logged in to post tweets", 403));
	}

	// create new tweet and insert into the database
	$tweet = new Tweet(generateUuidV4(), $_SESSION["profile"]->getProfileId, $requestObject->tweetContent, null);
	$tweet->insert($pdo);

	// update reply
	$reply->message = "Tweet created OK";
}

}