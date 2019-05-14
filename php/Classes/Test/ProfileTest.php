<?php
namespace CareerBusters\WebDevJobs;
use CareerBusters\WebDevJobs\{Profile};

// require once statements
require_once(dirname(__DIR__) . "Classes/autoload.php");
require_once(dirname(__DIR__) . "/lib/uuid.php");

/**
 * Full PHPUnit test for Profile class
 * all PDO methods are tested for invalid inputs.
 */
class ProfileTest extends DataDesignTest {
	/**
 	* Valid id to create profile
 	* @var $VALID_PROFILE_ID
 	*/
	protected $VALID_PROFILE_ID;

	/**
	 * Role of Profile; this is for foreign key relations
	 * @var  $roleId
	 **/
	protected $roleId;

	
}