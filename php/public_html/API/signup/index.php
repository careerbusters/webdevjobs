<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/php/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");

use CareerBusters\WebDevJobs;
use CareerBusters\WebDevJobs\Profile;

{

	// we only use the profile class for testing purposes
	Profile;
};


/**
 * api for the Profile class
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
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/CareerBusters");
	$pdo = $secrets->getPdoObject();

	//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];
	if($method ==="POST"){

		//have to decode json and turn it into a php object
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);
	}
	$profileId = generateUuidV4();
	$profileActivationToken = bin2hex(random_bytes(16));
	//profile Bio is a required field
	if (empty($requestObject->profileBio) === true) {
		throw(new \InvalidArgumentException("No profile Bio is present", 405));
	}
	//check profile email is a required field
	if (empty($requestObject->profileEmail) === true) {
		throw(new \InvalidArgumentException("No profile email is present", 405));
	}
	$newProfileHash = password_hash($requestObject->profilePassword, PASSWORD_ARGON2I, ["time_cost" => 384]);

	//verify that profile password is present
	if(empty($requestObject->profileImage) === true) {
		throw(new \InvalidArgumentException("no profile image present", 405));
	}
//verify that profile password is present
	if(empty($requestObject->profileLocation) === true) {
		throw(new \InvalidArgumentException("Location must be Albuquerque", 405));
	}
//verify that profile password is present
	if(empty($requestObject->profileUsername) === true) {
		throw(new \InvalidArgumentException("Must input valid username", 405));
	}
	// profile object needs to be created and prepare to insert into the database
	$profile = new Profile($profileId, $profileActivationToken, $requestObject->profileEmail, $requestObject->profileImage, $requestObject->profileLocation, $requestObject->profileUsername, $requestObject->profileBio, $newProfileHash);
	//insert the profile into the database
	$profile->insert($pdo);
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
<h2> Welcome to Whats-For-Lunch!</h2>
<p>Sign in to Save your Favorites and confirm your account</p>
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
	$recipients = [$requestObject->profileEmail];
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
	if ($numSent !== count($recipients)) {
		//the $failedRecipients parameter passed in the send () method now contains an array of the Emails that failed
		throw(new RuntimeException("Unable to send mail", 400));
	}
	// update reply
	$reply->message = "";
} else {
	throw(new InvalidArgumentException("invalid http request"));
}
} catch (\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
	$reply->trace = $exception->getTraceAsString();
}
header("Content-type: application/json");
echo json_encode($reply);

