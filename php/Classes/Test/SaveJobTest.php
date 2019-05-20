<?php

namespace CareerBuster\WebDevJobs\Test;

use CareerBusters\WebDevJobs\SavedJob;

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
	 * Saved job posting id that created the Saved Job; this is for foreign key relations
	 * @var SavedJob savedJob
	 **/
	protected $savedJobPostingId = null;

	/**
	 * content of the Saved Job Name
	 * @var string $VALID_SAVEDJOBNAME
	 **/
	protected $VALID_SAVEDJOBNAME = "PHPUnit test passing";

	/**
	 * content of the Saved Job Name
	 * var string $VALID_SAVEDJOBNAME2 = "PHPUnit test still passing";
	 **/
	protected $VALID_SAVEDJOBNAME2 = "PHPUnit test passing";

	/**
	 * Saved job profile id that created the Saved Job; this is for foreign key relations
	 * @var SavedJob savedJob
	 **/
	protected $savedJobProfileId = null;

	/**
	 * content of the Saved Profile Name
	 * @var string $VALID_SAVEDJOBPROFILENAME
	 **/
	protected $VALID_SAVEDJOBPROFILENAME = "PHPUnit test passing";

	/**
	 * content of the Saved Job Profile Name
	 * var string $VALID_SAVEDJOBPROFILENAME2 = "PHPUnit test still passing";
	 **/
	protected $VALID_SAVEDJOBPROFILENAME2 = "PHPUnit test passing";


	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp(): void {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a Profile to own the test saved job
		$this->profile = new profile(generateUuidV4(), null, "@handle", "https://webdev.cb.com. test@phpunit.com", $this->VALID_SAVEDJOBPROFILENAME,);
		$this->profile->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Saved Job and verify that the actual mySQL data matches
	 **/
	public function testInsertValidSavedJob(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("savedJob");

		// create a new Saved Job and insert to into mySQL
		$savedJobPostingId = generateUuidV4();
		$savedJob = new SavedJob($savedJobPostingId, $this->profile->getSavedJobProfileId(), $this->VALID_SAVEDJOBNAME, $this->VALID_SAVEDJOBPROFILENAME);

		$savedJob->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSavedJob = SavedJob::getSavedJobBySavedJobPostingId($this->getPDO(), $savedJob->getSavedJobPostingId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("savedJob"));
		$this->assertEquals($pdoSavedJob->getSavedJobPostingId(), $savedJobPostingId);
		$this->assertEquals($pdoSavedJob->getSavedJobProfileId(), $this->profile->getSavedJobProfileId());
		$this->assertEquals($pdoSavedJob->getSavedJobName(), $this->VALID_SAVEDJOBNAME);
	}

	/**
	 * test inserting a Saved Job, editing it, and then updating it
	 **/
	public function testUpdateValidSavedJob(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("savedJob");

		// create a new Saved Job and insert to into mySQL
		$savedJobPostingId = generateUuidV4();
		$savedJob = new SavedJob($savedJobPostingId, $this->profile->getProfileId(), $this->VALID_SAVEDJOBNAME, $this->VALID_SAVEDJOBPROFILENAME);
		$savedJob->insert($this->getPDO());

		// edit the Saved Job and update it in mySQL
		$savedJob->setSavedJobName($this->VALID_SAVEDJOBNAME2);
		$savedJob->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSavedJob = SavedJob::getSavedJobBySavedJobPostingId($this->getPDO(), $savedJob->getSavedJobPostingId());
		$this->assertEquals($pdoSavedJob->getSavedJobPostingId(), $savedJobPostingId);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("savedJob"));
		$this->assertEquals($pdoSavedJob->getSavedJobProfileId(), $this->profile->getSavedJobProfileId());
		$this->assertEquals($pdoSavedJob->getSavedJobName(), $this->VALID_SAVEDJOBNAME2);
	}

	/**
	 *  test creating a Saved Job and then deleting it
	 **/
	public function testDeleteValidSavedJob() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConncection()->getRowCount("savedJob");

		// create a new Saved Job and insert to into mySQL
		$savedJobPostingId = generateUuidV4();
		$savedJob = new SavedJob($savedJobPostingId, $this->profile->getSavedJobProfileId(), $this->VALID_SAVEDJOBNAME, $this->VALID_SAVEDJOBPROFILENAME);
		$savedJob->insert($this->getPDO());

		// delete the Saved Job from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("savedJob"));
		$savedJob->delete(($this->getPDO()));

		// grab the data from mySQL and enforce the Saved Job does not exist
		$pdoSavedJob = SavedJob::getSavedJobBySavedJobPostingId($this->getConnection()->getRowCount('savedJob'));
		$this->assertNull($pdoSavedJob);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("savedJob"));
	}

	/**
	 * test grabbing all Saved Jobs
	 **/
	public function testGetAllValidSavedJobs(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("savedJob");

		// create a new Saved Job and insert to into mySQL
		$savedJobPostingId = generateUuidV4();
		$savedJob = new SavedJob($savedJobPostingId, $this->savedJob->getSavedJobPostingId(), $this->VALID_SAVEDJOBNAME);
		$savedJob->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = SavedJob::getAllSavedJobs($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("savedJob"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("CareerBusters\\WebDevJob\\SavedJob", $results);

		// grab the result from the array and validate it
		$pdoSavedJob = $results[0];
		$this->assertEquals($pdoSavedJob->getSavedJobPostingId(), $savedJobPostingId);
		$this->assertEquals($pdoSavedJob->getSavedJobPostingId(), $this->savedJob->getSavedJobPostingId());
		$this->assertEquals($pdoSavedJob->getSavedJobName(), $this->VALID_SAVEDJOBNAME);
	}
}