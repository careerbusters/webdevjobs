<?php

namespace CareerBuster\WebDevJobs\Test;

use CareerBuster\WebDevJobs\Role;

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
	 * create dependent objects before running each test
	 **/
	public final function setUp(): void {
		// run the default setUp() method first
		parent::setUp();
	}