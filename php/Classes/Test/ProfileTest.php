<?php
namespace CareerBusters\WebDevJobs;
use CareerBusters\WebDevJobs\{Profile};

// require once statements
require_once(dirname(__DIR__) . "/autoload.php");
require_once(dirname(__DIR__) . "/lib/uuid.php");

/**
 * Full PHPUnit test for Profile class
 * all PDO methods are tested for invalid inputs.
 */
class ProfileTest extends DataDesignTest {

	/**
	 * the profile
	 * @var Profile profile
	 **/
	protected $profile;

	/**
	 * Role of Profile; this is for foreign key relations
	 * @var  $roleId
	 **/
	protected $role;

	/**
	 * placeholder until account activation is created
	 * @var string $VALID_ACTIVATION
	 */
	protected $VALID_ACTIVATION;

	/**
	 * placeholder until account bio is created
	 * @var string $VALID_BIO
	 */
	protected $VALID_BIO = "i code stuff";

	/**
	 * placeholder until account email is created
	 * @var string $VALID_EMAIL
	 */
	protected $VALID_EMAIL = "realemail@gmail.com";

	/**
	 * placeholder until account hash is created
	 * @var string $VALID_HASH
	 */
	protected $VALID_HASH;

	/**
	 * placeholder until account image is created
	 * @var string $VALID_IMAGE
	 */
	protected $VALID_IMAGE = "http://placemorty.us/300/200";

	/**
	 * placeholder until account location is created
	 * @var string $VALID_LOCATION
	 */
	protected $VALID_LOCATION = "Corrales";

	/**
	 * placeholder until account username is created
	 * @var string $VALID_USERNAME1
	 */
	protected $VALID_USERNAME1 = "passing";

	/**
	 * placeholder until account location is created
	 * @var string $VALID_LOCATION
	 */
	protected $VALID_USERNAME2 = "stillpassing";


	/**
	 * run the default setup operation to create salt and hash.
	 */
	public final function setUp() : void {
		parent::setUp();
		//
		$password = "password1";
		$this->VALID_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));
	}

}