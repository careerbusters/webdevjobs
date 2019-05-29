<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");

use CareerBusters\WebDevJobs\{Posting};

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
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//get a specific tweet based on arguments provided or all the tweets and update reply
		if(empty($id) === false) {
			$reply->data = Posting::getPostingByPostingId($pdo, $id);
		} else if(empty($tweetProfileId) === false) {
			$reply->data = Posting::getPostingByPostingProfileId($pdo, $postingProfileId)->toArray();
		} else if(empty($tweetContent) === false) {
			$reply->data = Posting::getPostingByPostingRoleId($pdo, $postingRoleId)->toArray();
		} else {
			$reply->data = Posting::getAllPostings($pdo)->toArray();
		}
	}

	//perform the actual put or post
	if($method === "PUT") {

		// retrieve the tweet to update
		$posting = Posting::getPostingByPostingId($pdo, $id);
		if($posting === null) {
			throw(new RuntimeException("posting does not exist", 404));
		}

		//enforce the user is signed in and only trying to edit their own tweet
		if(empty($_SESSION["profile"]) === true || $_SESSION["profile"]->getProfileId()->toString() !== $posting->getPostingProfileId()->toString()) {
			throw(new \InvalidArgumentException("You are not allowed to edit this tweet", 403));
		}

		// update all attributes
		$posting->setPostingDate($requestObject->postingDate);
		$posting->setPostingContent($requestObject->postingContent);
		$posting->update($pdo);

		// update reply
		$reply->message = "job posting OK";
		if($method === "POST") {

			//have to decode json and turn it into a php object
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);
		}
		//profile Bio is a required field
		if(empty($requestObject->postingContent) === true) {
			throw(new \InvalidArgumentException("content is empty", 405));
		}
		//check profile email is a required field
		if(empty($requestObject->postingEmail) === true) {
			throw(new \InvalidArgumentException("No email is present", 405));
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
			throw(new \InvalidArgumentException("Location must be Albuquerque", 405));
		}
//verify that profile password is present
		if(empty($requestObject->postingPay) === true) {
			throw(new \InvalidArgumentException("Must input the amount the job pays", 405));

			//verify that profile password is present
			if(empty($requestObject->postingPasswordConfirm) === true) {
				throw(new \InvalidArgumentException("Must input valid password", 405));
			}
			//verify that profile password is present
			if(empty($requestObject->postingPasswordConfirm) === true) {
				throw(new \InvalidArgumentException("Must input valid password", 405));
			}

			//do the values below  get assigned on sign up or after activation?
			$profileAgent = $_SERVER['HTTP_Profile_AGENT'];
			$profileIpAddress = $_SERVER['SERVER_ADDR'];
			//user blocked? using 0 as default
			$profileBlocked = 0;

			//do the values below for signup and activate
			$newProfileHash = password_hash($requestObject->profilePassword, PASSWORD_ARGON2I, ["time_cost" => 384]);
			$profileActivationToken = bin2hex(random_bytes(16));
			$profileId = generateUuidV4();
		}
		// profile object needs to be created and prepare to insert into the database
		$posting = new Posting($profileId, $profileActivationToken, $requestObject->profileEmail, $requestObject->profileImage, $requestObject->profileLocation, $requestObject->profileUsername, $requestObject->profileBio, $newProfileHash);
		//insert the profile into the database
		$posting->insert($pdo);
		//compose the email message to send with the activation token
		$messageSubject = "One step closer -- Account Activation";
		//building the activation link that can travel to another server and still work. This is the link that will be clicked to confirm to the account.
		//make sure URL is /public_html/api/activation/$activation
		$basePath = dirname($_SERVER["SCRIPT_NAME"], 3);
		//create the path
		$urlGlue = $basePath . "/api/activation/?activation=" . $profileActivationToken;
		//create the redirect link
		$confirmLink = "https://" . $_SERVER["SERVER_NAME"] . $urlGlue;
		//compose message to send with email
		$message = <<< EOF
<h2> Welcome to CareerBusters</h2>
<p>Post a job</p>
<p><a href="$confirmLink">$confirmLink</a></p>
EOF;
		//created a swift email
		$swiftMessage = new Swift_Message();
		// attach the sender to the message
		//this takes the form of an associative array where the email is the key to a real name
		$swiftMessage->setFrom(["youngblkraven@gmail.com" => "Youngblkraven"]);
		/**
		 * attach recipients to the message
		 * notice this is an array that can include or omit the recipient's name
		 * use the recipient's real name where possible;
		 * this reduces the probability of the email is marked as spam
		 */
		//define who the recipient is
		$recipients = [$requestObject->postingEmail];
		//set the recipient to the swift message
		$swiftMessage->setTo($recipients);
		//attach the subject line to the email message
		$swiftMessage->setSubject($messageSubject);
		/**
		 * attach the message to the email
		 * set two versions of the message: a html formatted version and a filter_var() of the message, plain text
		 * notice the tactic used is to display the entire $confirmLink to plain text
		 * this let users who are not viewing the html content to still access the link
		 */
		//attach the html verizon for the message
		$swiftMessage->setBody($message, "text/html");
		//attach the plain text version of the message
		$swiftMessage->addPart(html_entity_decode($message), "text/plain");
		/**
		 * send the Email via SMTp; the SMTP server here is configured to relay everything upstream via CNM
		 * ths default may or may not be available on all web hosts; consult their documentation/support for details
		 * SwiftMailer support many different transport methods; SMTP was chosen because it's the most compatible and has the best error handling
		 * @see https://swiftmailer.org/docs/sending.html Sending Messages - Documentation - SwiftMailer
		 */
		//setup SMTP
		$smtp = new Swift_SmtpTransport("localhost", 25);

		$mailer = new Swift_Mailer($smtp);
		//send the message
		$numSent = $mailer->send($swiftMessage, $failedRecipients);
		/**
		 * the send method returns the number of recipients that accepted the Email
		 * so, if the number attempted is not the number accepted, this is an Exception
		 */
		if($numSent !== count($recipients)) {
			//the $failedRecipients parameter passed in the send () method now contains an array of the Emails that failed
			throw(new RuntimeException("Unable to send mail", 400));
		}
		// update reply
		$reply->message = "job posted created";
	}

else if($method === "DELETE") {

	//enforce that the end user has a XSRF token.
	verifyXsrf();

	// retrieve the Tweet to be deleted
	$Posting = Posting::getPostingByPostingId($pdo, $id);
	if($Posting === null) {
		throw(new RuntimeException("job posting does not exist", 404));
	}

	//enforce the user is signed in and only trying to edit their own job posting
	if(empty($_SESSION["profile"]) === true || $_SESSION["profile"]->getProfileId() !== $posting->getPostingProfileId()) {
		throw(new \InvalidArgumentException("You are not allowed to delete this job posting", 403));
	}

	// delete job posting
	$posting->delete($pdo);
	// update reply
	$reply->message = "job posting deleted";
}}
catch (\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
	$reply->trace = $exception->getTraceAsString();
}
// encode and return reply to front end caller
header("Content-type: application/json");
echo json_encode($reply);


