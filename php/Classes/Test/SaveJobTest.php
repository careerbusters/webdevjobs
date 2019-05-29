<?php

namespace CareerBusters\WebDevJobs\Test;


use CareerBusters\WebDevJobs\{Profile, Posting, Role, SavedJob, Test\WebDevJobsTest};


// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * Full PHPUnit test for the Saved Job Class
 *
 * This is a complete PHPUnit test of the Saved Job class. It is complete because *ALL*
 * mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see SavedJobTest
 * @author Natasha Lovato <nmarshlovato@cnm.edu>
 **/
class SavedJobTest extends WebDevJobsTest {

	/**
	 * Role of Posting; this is for foreign key relations
	 * @var  Role $roleId
	 **/
	protected $role;
	/**
	 * Saved job posting id that created the Saved Job; this is for foreign key relations
	 * @var SavedJob savedJob
	 **/
	protected $posting;

	/**
	 * Saved job profile id that created the Saved Job; this is for foreign key relations
	 * @var SavedJob savedJob
	 **/
	protected $profile;

	/**
	 * Valid hash for the profile
	 * @var $VALID_PROFILE_HASH
	 **/
	protected $VALID_PROFILE_HASH;

	/**
	 * timestamp of the posting
	 * @var \DateTime $VALID_POSTINGENDDATE
	 */
	protected $VALID_POSTINGDATE;

	/**
	 * timestamp of the posting end date
	 * @var \DateTime $VALID_POSTINGENDDATE
	 */
	protected $VALID_POSTINGENDDATE = null;

	/**
	 * content of the Saved Job Name
	 * @var string $VALID_SAVEDJOBNAME
	 **/
	protected $VALID_SAVEDJOBNAME = "PHPUnit test passing";


	/**
	 * content of the Saved Profile Name
	 * @var string $VALID_SAVEDJOBPROFILENAME
	 **/
	protected $VALID_SAVEDJOBPROFILENAME = "PHPUnit test passing";


	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp(): void {
		// run the default setUp() method first
		parent::setUp();
		$password = "abc123";
		$this->VALID_PROFILE_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$activation = bin2hex(random_bytes(16));
		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_POSTINGDATE = new \DateTime();
		$this->VALID_POSTINGENDDATE = new \DateTime();

		// create and insert a mocked Role
		$this->role = new Role(generateUuidV4(), "recruiter");
		$this->role->insert($this->getPDO());

		// create and insert the mocked profile
		$this->profile = new Profile(generateUuidV4(), $this->role->getRoleId(), $activation, "blahblah", "test@phpunit.com", $this->VALID_PROFILE_HASH, "https://blamedan.us", "Santa Fe", "Dill Pickle");
		$this->profile->insert($this->getPDO());

		// create and insert the mocked posting
		$this->posting = new Posting(generateUuidV4(), $this->profile->getProfileId(), $this->role->getRoleId(), "Deep Dive Coding", "Get a job at Deep Dive!", $this->VALID_POSTINGDATE, "natasha@email.com", $this->VALID_POSTINGENDDATE, "Santa Fe", "$50,000.00", "Junior Developer");
		$this->posting->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Saved Job and verify that the actual mySQL data matches
	 **/
	public function testInsertValidSavedJob(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("savedJob");

		// create a new Job and insert to into mySQL
		$savedJob = new SavedJob($this->posting->getPostingId(), $this->profile->getProfileId());
		$savedJob->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSavedJob = SavedJob::getSavedJobBySavedJobPostingIdAndSavedJobProfileId($this->getPDO(), $savedJob->getSavedJobPostingId(), $savedJob->getSavedJobProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("savedJob"));
		$this->assertEquals($pdoSavedJob->getSavedJobPostingId(), $this->posting->getPostingId());
		$this->assertEquals($pdoSavedJob->getSavedJobProfileId(), $this->profile->getProfileId());
	}


	/**
	 *  test creating a Saved Job and then deleting it
	 **/
	public function testDeleteValidSavedJob() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("savedJob");

		// create a new Job and insert to into mySQL
		$savedJob = new SavedJob($this->posting->getPostingId(), $this->profile->getProfileId());
		$savedJob->insert($this->getPDO());

		// delete the Saved Job from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("savedJob"));
		$savedJob->delete(($this->getPDO()));

		// grab the data from mySQL and enforce the Saved Job does not exist
		$pdoSavedJob = SavedJob::getSavedJobBySavedJobPostingIdAndSavedJobProfileId($this->getPDO(), $savedJob->getSavedJobPostingId(), $savedJob->getSavedJobProfileId());
		$this->assertNull($pdoSavedJob);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("savedJob"));
	}

	/**
	 * test grabbing a Saved Job by saved job content
	 **/
	public function testGetValidSavedJobBySavedJobProfileId(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("savedJob");

		// create a new Job and insert to into mySQL
		$savedJob = new SavedJob($this->posting->getPostingId(), $this->profile->getProfileId());
		$savedJob->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = SavedJob::getSavedJobBySavedJobProfileId($this->getPDO(), $savedJob->getSavedJobProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("savedJob"));
		$this->assertCount(1, $results);


		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("CareerBusters\\WebDevJobs\\SavedJob", $results);

		// grab the result from the array and validate it
		$pdoSavedJob = $results[0];
		$this->assertEquals($pdoSavedJob->getSavedJobPostingId(), $this->posting->getPostingId());
		$this->assertEquals($pdoSavedJob->getSavedJobProfileId(), $this->profile->getProfileId());
	}
}