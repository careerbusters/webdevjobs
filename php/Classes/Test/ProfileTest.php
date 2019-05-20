<?php
namespace CareerBusters\WebDevJobs\Test;
use CareerBusters\WebDevJobs\Profile;

// require once statements
require_once(dirname(__DIR__) . "/autoload.php");
require_once(dirname(__DIR__) . "/lib/uuid.php");

/**
 * Full PHPUnit test for Profile class
 * all PDO methods are tested for invalid inputs.
 */
class ProfileTest extends WebDevJobsTest {

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
	protected $VALID_USERNAME = "passing";

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
		// creating role content
		$this->role = new Role(generateUuidv4(), "Role Name");
		$this->role->insert($this->getPDO);
	}

	/**
	 * test inserting a Profile and verify the mySQL matches
	 **/
	public function testInsertValidProfile() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->role->getRoleId(), $this->VALID_ACTIVATION, $this->VALID_BIO, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_IMAGE, $this->VALID_LOCATION, $this->VALID_USERNAME);
		$profile->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileBio(), $this->VALID_BIO );
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfileImage(), $this->VALID_IMAGE);
		$this->assertEquals($pdoProfile->getProfileLocation(), $this->VALID_LOCATION);
		$this->assertEquals($pdoProfile->getProfileUsername(), $this->VALID_USERNAME);
	}


	/**
	 * test inserting a Profile, editing it, and then updating it
	 **/
	public function testUpdateValidProfile() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		// create a new Profile and insert to into mySQL
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->role->getRoleId(), $this->VALID_ACTIVATION, $this->VALID_BIO, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_IMAGE, $this->VALID_LOCATION, $this->VALID_USERNAME);
		$profile->insert($this->getPDO());
		// edit the Profile and update it in mySQL
		$profile->setProfileUsername($this->VALID_USERNAME2);
		$profile->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileBio(), $this->VALID_BIO );
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfileImage(), $this->VALID_IMAGE);
		$this->assertEquals($pdoProfile->getProfileLocation(), $this->VALID_LOCATION);
		$this->assertEquals($pdoProfile->getProfileUsername(), $this->VALID_USERNAME2);
	}

	/**
	 * test creating a Profile and then deleting it
	 **/
	public function testDeleteValidProfile() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->role->getRoleId(), $this->VALID_ACTIVATION, $this->VALID_BIO, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_IMAGE, $this->VALID_LOCATION, $this->VALID_USERNAME);
		$profile->insert($this->getPDO());
		// delete the Profile from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$profile->delete($this->getPDO());
		// grab the data from mySQL and enforce the Profile does not exist
		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertNull($pdoProfile);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("profile"));
	}

	/**
	 * test inserting a Profile and grabbing it from mySQL
	 **/
	public function testGetValidProfileByProfileRoleId() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->role->getRoleId(), $this->VALID_ACTIVATION, $this->VALID_BIO, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_IMAGE, $this->VALID_LOCATION, $this->VALID_USERNAME);
		$profile->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileRoleId($this->getPDO(), $profile->getProfileRoleId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileBio(), $this->VALID_BIO );
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfileImage(), $this->VALID_IMAGE);
		$this->assertEquals($pdoProfile->getProfileLocation(), $this->VALID_LOCATION);
		$this->assertEquals($pdoProfile->getProfileUsername(), $this->VALID_USERNAME);
	}

	/**
	 * test inserting a Profile and grabbing it from mySQL
	 **/
	public function testGetValidProfileByProfileActivationToken() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->role->getRoleId(), $this->VALID_ACTIVATION, $this->VALID_BIO, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_IMAGE, $this->VALID_LOCATION, $this->VALID_USERNAME);
		$profile->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileActivationToken($this->getPDO(), $profile->getProfileActivationToken());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileBio(), $this->VALID_BIO );
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfileImage(), $this->VALID_IMAGE);
		$this->assertEquals($pdoProfile->getProfileLocation(), $this->VALID_LOCATION);
		$this->assertEquals($pdoProfile->getProfileUsername(), $this->VALID_USERNAME);
	}

	/**
	 * test inserting a Profile and grabbing it from mySQL
	 **/
	public function testGetValidProfileByProfileEmail() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->role->getRoleId(), $this->VALID_ACTIVATION, $this->VALID_BIO, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_IMAGE, $this->VALID_LOCATION, $this->VALID_USERNAME);
		$profile->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileEmail($this->getPDO(), $profile->getProfileEmail());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileBio(), $this->VALID_BIO );
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfileImage(), $this->VALID_IMAGE);
		$this->assertEquals($pdoProfile->getProfileLocation(), $this->VALID_LOCATION);
		$this->assertEquals($pdoProfile->getProfileUsername(), $this->VALID_USERNAME);
	}

	/**
	 * test inserting a Profile and grabbing it from mySQL  FOR ARRAY
	 **/
	public function testGetValidProfilesByProfileUsername() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->role->getRoleId(), $this->VALID_ACTIVATION, $this->VALID_BIO, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_IMAGE, $this->VALID_LOCATION, $this->VALID_USERNAME);
		$profile->insert($this->getPDO());
		//grab the data from MySQL
		$results = Profile::getProfileByProfileUsername($this->getPDO(), $this->VALID_USERNAME);
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("profile"));
		//enforce no other objects are bleeding into profile
		$this->assertContainsOnlyInstancesOf("CareerBusters\\WebDevJobs\\Profile", $results);
		//enforce the results meet expectations
		$pdoProfile = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileBio(), $this->VALID_BIO );
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfileImage(), $this->VALID_IMAGE);
		$this->assertEquals($pdoProfile->getProfileLocation(), $this->VALID_LOCATION);
		$this->assertEquals($pdoProfile->getProfileUsername(), $this->VALID_USERNAME);
	}

	/**
	 * test inserting a Profile and grabbing it from mySQL SINGLE OBJECT
	 **/
	public function testGetValidProfileByProfileUsername() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->role->getRoleId(), $this->VALID_ACTIVATION, $this->VALID_BIO, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_IMAGE, $this->VALID_LOCATION, $this->VALID_USERNAME);
		$profile->insert($this->getPDO());
		//grab the data from MySQL
		$pdoProfile = Profile::getProfileByProfileUsername($this->getPDO(), $profile->getProfileUsername());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileBio(), $this->VALID_BIO );
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfileImage(), $this->VALID_IMAGE);
		$this->assertEquals($pdoProfile->getProfileLocation(), $this->VALID_LOCATION);
		$this->assertEquals($pdoProfile->getProfileUsername(), $this->VALID_USERNAME);
	}
}