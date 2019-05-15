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
	 * @var  $roleId
	 **/
	protected $role;
	/**
	 * Role of Posting; this is for foreign key relations
	 * @var  $postingId
	 **/
	protected $profile;
	/** Posting company name that created the Posting
	 * @var $Valid_PostingCompanyName
	 */
	protected $Valid_POSTINGCOMPANYNAME;
	/**
	 *posting content that created the Posting
	 * @var $Valid_PostingContent
	 */
	protected $Valid_POSTINGCONTENT = "PHPUnit test passing";
	/**
	 * timestamp of the posting
	 * @var \DateTime $Valid_PostingDate
	 */
	protected $Valid_POSTINGDATE = null;
	/**
	 * posting email address of the posting
	 * @var $Valid_PostingEmail
	 */
	protected $Valid_POSTINGEMAIL;
	/**
	 * timestamp of the posting
	 * @var \DateTime $Valid_PostingEndDate
	 */
	protected $Valid_POSTINGENDDATE = null;
	/**
	 * posting location of the posting
	 * @var $Valid_PostingLocation
	 */
	protected $Valid_POSTINGLOCATION;
	/**
	 * posting pay for the posting
	 * @var $Valid_PostingPay
	 */
	protected $Valid_POSTINGPAY;
	/**
	 * posting title of the posting
	 * @var $Valid_PostingTitle
	 */
	protected $Valid_POSTINGTITLE;


	/**
	 * create dependent objects before running each test
	 */
	public final function setUp(): void {
		// create and insert a postingCompanyName to the test Posting
		$this->postingCompanyName = new postingCompanyName;
		$this->Valid_POSTINGCOMPANYNAME->insert($this->getPDO());

		// create and insert a postingContent to the test Posting
		$this->postingContent = new postingContent;
		$this->Valid_POSTINGCONTENT->insert($this->getPDO());

		// calculate the date (just use the time the unit test was setup...)
		$this->Valid_POSTINGDATE->new \DateTime();

	// create and insert a postingEmail to the test Posting
	$this->postingEmail = new postingEmail;
	$this->Valid_POSTINGEMAIL->insert($this->getPDO());

	// calculate the date (just use the time the unit test is finished...)
	$this->Valid_POSTINGENDDATE->new \DateTime();

	// create and insert a postingLocation to the test Posting
	$this->postingLocation = new postingLocation;
	$this->Valid_POSTINGLOCATION->insert($this->getPDO());

		// create and insert a postingPay to the test Posting
	$this->postingPay = new postingPay;
	$this->Valid_POSTINGPAY->insert($this->getPDO());

		// create and insert a postingTitle to the test Posting
	$this->postingTitle = new postingTitle;
	$this->Valid_POSTINGTITLE->insert($this->getPDO());
}

/**
 * test inserting a valid Posting and verify that the actual mySQL data matches
 **/
	public function testInsertValidPosting() : void {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("posting");

	// create a new Posting and insert to into mySQL
	$postingId = generateUuidV4();
	$posting = new posting($postingId, $this->posting->getPostingId(), $this->VALID_POSTINGCOMPANY, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
	$posting->insert($this->getPDO());

	// grab the data from mySQL and enforce the fields match our expectations
	$pdoPosting = Posting::getPostingByPostingId($this->getPDO(), $posting->getPostingId());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
	$this->assertEquals($pdoPosting->getPostingId(), $postingId);
	$this->assertEquals($pdoPosting->getPostingId(), $this->profile->getProfileId());
	$this->assertEquals($pdoPosting->getPostingCompany(), $this->VALID_POSTINGCOMPANY);
	$this->assertEquals($pdoPosting->getPostingContent(), $this->VALID_POSTINGCONTENT);
	$this->assertEquals($pdoPosting->getPostingEmail(), $this->VALID_POSTINGEMAIL);
	$this->assertEquals($pdoPosting->getPostingLocation(), $this->VALID_POSTINGLOCATION);
	$this->assertEquals($pdoPosting->getPostingPay(), $this->VALID_POSTINGPAY);
	$this->assertEquals($pdoPosting->getPostingTitle(), $this->VALID_POSTINGTITLE);
	//format the date too seconds since the beginning of time to avoid round off error
	$this->assertEquals($pdoPosting->getPostingDate()->getTimestamp(), $this->VALID_POSTINGDATE->getTimestamp());
}