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
	$roleName = $id = filter_input(INPUT_GET, "")

	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();
		//gets  a specific like associated based on its composite key
		if ($roleId !== null && $roleName !== null) {
			$like = Like::getRoleByRoleIdAndRoleName($pdo, $roleId, $roleName);

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

		}
