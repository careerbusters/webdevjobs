<?php

namespace CareerBusters\WebDevJobs\Test;

use CareerBusters\WebDevJobs\Posting;

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 *Full PHPUnit test for the Posting class
 */
class PostingTest extends WebDevjobsTest {
	/**
	 * the posting
	 * @var Posting
	 **/
	protected $posting;
	/**
	 * Role of Posting; this is for foreign key relations
	 * @var  $postingroleId
	 **/
	protected $role;
	/**
	 * Profile of the Posting; this is for foreign key relations
	 * @var  $postingProfileId
	 **/
	protected $profile;
	/** Posting company name that created the Posting
	 * @var $VALID_PostingCompanyName
	 */
	protected $VALID_POSTINGCOMPANYNAME;
	/**
	 *posting content that created the Posting
	 * @var $VALID_PostingContent
	 */
	protected $VALID_POSTINGCONTENT = "PHPUnit test passing";
	/**
	 * timestamp of the posting
	 * @var \DateTime $VALID_PostingDate
	 */
	protected $VALID_POSTINGDATE = null;
	/**
	 * posting email address of the posting
	 * @var $VALID_PostingEmail
	 */
	protected $VALID_POSTINGEMAIL;
	/**
	 * timestamp of the posting
	 * @var \DateTime $VALID_PostingEndDate
	 */
	protected $VALID_POSTINGENDDATE = null;
	/**
	 * posting location of the posting
	 * @var $VALID_PostingLocation
	 */
	protected $VALID_POSTINGLOCATION;
	/**
	 * posting pay for the posting
	 * @var $VALID_PostingPay
	 */
	protected $VALID_POSTINGPAY;
	/**
	 * posting title of the posting
	 * @var $VALID_PostingTitle
	 */
	protected $VALID_POSTINGTITLE;


	/**
	 * create dependent objects before running each test
	 */
	public final function setUp(): void {
// run the default setUp() method first
		parent::setUp();

		// create and insert a postingCompanyName to the test Posting
		$this->postingCompanyName = new postingCompanyName;
		$this->VALID_POSTINGCOMPANYNAME->insert($this->getPDO());

		// create and insert a postingContent to the test Posting
		$this->postingContent = new postingContent;
		$this->VALID_POSTINGCONTENT->insert($this->getPDO());

		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_POSTINGDATE->new \DateTime();
		$this->VALID_POSTINGDATE->sub(new \DateInterval("P10D"));

	// create and insert a postingEmail to the test Posting
	$this->postingEmail = new postingEmail;
	$this->VALID_POSTINGEMAIL->insert($this->getPDO());

	// calculate the date (just use the time the unit test is finished...)
	$this->VALID_POSTINGENDDATE->new \DateTime();
	$this->VALID_POSTINGENDDATE->sub(new \DateInterval("P10D"));

	// create and insert a postingLocation to the test Posting
	$this->postingLocation = new postingLocation;
	$this->VALID_POSTINGLOCATION->insert($this->getPDO());

		// create and insert a postingPay to the test Posting
	$this->postingPay = new postingPay;
	$this->VALID_POSTINGPAY->insert($this->getPDO());

		// create and insert a postingTitle to the test Posting
	$this->postingTitle = new postingTitle;
	$this->VALID_POSTINGTITLE->insert($this->getPDO());
}

	/**
	 * test inserting a valid Posting and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPosting(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("posting");

		// create a new Posting and insert to into mySQL
		$postingId = generateUuidV4();
		$postingRoleId = generateUuidV4();
		$postingProfileId = generateUuidV4();
		$posting = new Posting($postingId, $postingRoleId, $postingProfileId, $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPosting = Posting::getPostingByPostingId($this->getPDO(), $posting->getPostingId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertEquals($pdoPosting->getPostingId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingRoleId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingProfileId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingCompany(), $this->VALID_POSTINGCOMPANYNAME);
		$this->assertEquals($pdoPosting->getPostingContent(), $this->VALID_POSTINGCONTENT);
		$this->assertEquals($pdoPosting->getPostingEmail(), $this->VALID_POSTINGEMAIL);
		$this->assertEquals($pdoPosting->getPostingLocation(), $this->VALID_POSTINGLOCATION);
		$this->assertEquals($pdoPosting->getPostingPay(), $this->VALID_POSTINGPAY);
		$this->assertEquals($pdoPosting->getPostingTitle(), $this->VALID_POSTINGTITLE);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoPosting->getPostingDate()->getTimestamp(), $this->VALID_POSTINGDATE->getTimestamp());
	}

	/**
	 *test inserting a Posting, editing it, and then update it
	 */
	public function testUpdateValidPosting(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("posting");

		//create a new Posting and insert to into mySQL
		$postingId = generateUuidV4();
		$postingRoleId = generateUuidV4();
		$postingProfileId = generateUuidV4();
		$posting = new Posting($postingId, $postingRoleId, $postingProfileId, $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());

		// edit the Posting and update it in mySQL
		$posting->setPostingContent($this->VALID_POSTINGCONTENT);
		$posting->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPosting = Posting::getPostingByPostingId($this->getPDO(), $posting->getPostingId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertEquals($pdoPosting->getPostingId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingRoleId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingProfileId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingCompany(), $this->VALID_POSTINGCOMPANYNAME);
		$this->assertEquals($pdoPosting->getPostingContent(), $this->VALID_POSTINGCONTENT);
		$this->assertEquals($pdoPosting->getPostingEmail(), $this->VALID_POSTINGEMAIL);
		$this->assertEquals($pdoPosting->getPostingLocation(), $this->VALID_POSTINGLOCATION);
		$this->assertEquals($pdoPosting->getPostingPay(), $this->VALID_POSTINGPAY);
		$this->assertEquals($pdoPosting->getPostingTitle(), $this->VALID_POSTINGTITLE);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoPosting->getPostingDate()->getTimestamp(), $this->VALID_POSTINGDATE->getTimestamp());
	}

	/**
	 * test creating a Posting and then deleting it
	 */
	public function testDeleteValidPosting(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("posting");

		//create a new Posting and insert to into mySQL
		$postingId = generateUuidV4();
		$postingRoleId = generateUuidV4();
		$postingProfileId = generateUuidV4();
		$posting = new Posting($postingId, $postingRoleId, $postingProfileId, $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());

		// delete the Posting from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$posting->delete($this->getPDO());

		// grab the data from mySQL and enforce the Posting does not exist
		$pdoPosting = Posting::getPostingByPostingId($this->getPDO(), $posting->getPostingId());
		$this->assertNull($pdoPosting);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("posting"));
	}

	/**
	 *test grabbing a Posting by posting company name
	 */
	public function testGetValidPostingByPostingCompanyName(): void {

		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("posting");

		//create a new Posting and insert to into mySQL
		$postingId = generateUuidV4();
		$postingRoleId = generateUuidV4();
		$postingProfileId = generateUuidV4();
		$posting = new Posting($postingId, $postingRoleId, $postingProfileId, $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Posting::getPostingByPostingCompanyName($this->getPDO(), $posting->getPostingContent());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertCount(1, $results);
		//enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("CareerBusters\\WebDevJobs\\Test", $results);
	}
	}