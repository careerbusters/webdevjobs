<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
use CareerBusters\WebDevJobs\DataDesign\Profile{Role
};

/**
 * Api for the Role class
 *
 * @author nlovato
 **/

// verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/ddcrole.ini");
	$pdo = $secrets->getPdoObject();

	//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

	//saintize the search parameters
	$roleId =$id = filter_input(INPUT_GET, "roleProfileId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$roleName = $id = filter_input(INPUT_GET, "");

	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();
		//gets  a specific like associated based on its composite key
		if ($roleId !== null && $roleName !== null) {
			$role = Role::getRoleByRoleIdAndRoleName($pdo, $roleId, $roleName);

			if($role!== null) {
				$reply->data = $role;
			}
			//if none of the search parameters are met throw an exception
		} else if(empty($roleId) === false) {
			$reply->data = Role::getRoleByRoleId($pdo, $roleId)->toArray();
			//get all the likes associated with the tweetId
		} else if(empty($roleName) === false) {
			$reply->data = Role::getRoleByRoleName($pdo, $roleName)->toArray();
		} else {
			throw new InvalidArgumentException("incorrect search parameters ", 404);
		}
		if($method === "POST") {
			//enforce that the end user has a XSRF token.
			verifyXsrf();
			//enforce the end user has a JWT token
			validateJwtHeader();

			//grab the like by its composite key
			$role = Role::getRoleByRoleIdAndRoleName($pdo, $requestObject->roleId, $requestObject->roleName);
			if($role === null) {
				throw (new RuntimeException("Role does not exist"));
			}
			//enforce the user is signed in and only trying to edit their own like
			if(empty($_SESSION["role"]) === true || $_SESSION["role"]->getRoleId() !== $role->getRoleId()) {
				throw(new \InvalidArgumentException("You are not allowed to delete this role", 403));
			}
			//validateJwtHeader();
			//preform the actual delete
			$role->delete($pdo);
			//update the message
			$reply->message = "Role successfully deleted";
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

		}
