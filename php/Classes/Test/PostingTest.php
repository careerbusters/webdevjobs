<?php
namespace CareerBusters\WebDevJobs\Test;
use CareerBusters\WebDevJobs\Posting;
use CareerBusters\WebDevJobs\Profile;
use CareerBusters\WebDevJobs\Role;
use CareerBusters\WebDevJobs\WebDevJobsTest;

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");
/**
 *Full PHPUnit test for the Posting class
 */
class PostingTest extends WebDevJobsTest {
	/**
	 * the posting
	 * @var Posting $posting
	 **/
	protected $posting;
	/**
	 * Profile of the Posting; this is for foreign key relations
	 * @var  Profile $ProfileId
	 **/
	protected $profile;
	/**
	 * Role of Posting; this is for foreign key relations
	 * @var  Role $roleId
	 **/
	protected $role;
	/** Posting company name that created the Posting
	 * @var $VALID_POSTINGCOMPANYNAME
	 */
	protected $VALID_POSTINGCOMPANYNAME;
	/**
	 *posting content that created the Posting
	 * @var $VALID_POSTINGCONTENT
	 */
	protected $VALID_POSTINGCONTENT = "PHPUnit test passing";
	/**
	 * timestamp of the posting
	 * @var \DateTime $VALID_POSTINGDATE
	 */
	protected $VALID_POSTINGDATE = null;
	/**
	 * posting email address of the posting
	 * @var $VALID_POSTINGEMAIL
	 */
	protected $VALID_POSTINGEMAIL;
	/**
	 * timestamp of the posting
	 * @var \DateTime $VALID_POSTINGENDDATE
	 */
	protected $VALID_POSTINGENDDATE = null;
	/**
	 * posting location of the posting
	 * @var $VALID_POSTINGLOCATION
	 */
	protected $VALID_POSTINGLOCATION;
	/**
	 * posting pay for the posting
	 * @var $VALID_POSTINGPAY
	 */
	protected $VALID_POSTINGPAY;
	/**
	 * posting title of the posting
	 * @var $VALID_POSTINGTITLE
	 */
	protected $VALID_POSTINGTITLE;
	/**
	 * create dependent objects before running each test
	 */
	public final function setUp(): void {
// run the default setUp() method first
		parent::setUp();

		// create and insert a mocked Posting
		$this->posting = new Posting(generateUuidV4(), "Haven Tech", "PHPUnit test passing", "null", "test@phpuit.ey", "null", "Albuquerque", "50,000", "recruiter");
			$this->posting->insert($this->getPDO());
// create a salt and hash for the mocked profile
		$password = "abc123";
		$this->VALID_PROFILEHASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));
			// create the and insert the mocked profile
		$this->profile = new Profile(generateUuidV4(), $this->role->getRoleId(), "null", "freelancer", "test@phpunit.ey",$this->VALID_PROFILEHASH, "https://media.giphy.com/media/3og0INyCmHlNylks9O/giphy.gif", "Albuquerque", "freelancer");
		$this->profile->insert($this->getPDO());

		// create the and insert the mocked role
		$this->role = new Role(generateUuidV4(), "developer");
		$this->role->insert($this->getPDO());
		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_POSTINGDATE = new \DateTime();
		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_POSTINGENDDATE = new \DateTime();
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
		$posting = new Posting($postingId, $postingProfileId, $postingRoleId, $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPosting = Posting::getPostingByPostingId($this->getPDO(), $posting->getPostingId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertEquals($pdoPosting->getPostingId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingProfileId(), $postingProfileId);
		$this->assertEquals($pdoPosting->getPostingRoleId(), $postingRoleId);
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
		$postingProfileId = generateUuidV4();
		$postingRoleId = generateUuidV4();
		$posting = new Posting($postingId, $postingProfileId, $postingRoleId, $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());
		// edit the Posting and update it in mySQL
		$posting->setPostingContent($this->VALID_POSTINGCONTENT);
		$posting->update($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPosting = Posting::getPostingByPostingRoleId($this->getPDO(), $posting->getPostingId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertEquals($pdoPosting->getPostingId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingProfileId(), $postingProfileId);
		$this->assertEquals($pdoPosting->getPostingRoleId(), $postingRoleId);
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
	 *test postingProfileId from posting
	 */
	public function testValidPostingProfileId(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("posting");
		//create a new Posting and insert to into mySQL
		$postingId = generateUuidV4();
		$postingProfileId = generateUuidV4();
		$postingRoleId = generateUuidV4();
		$posting = new Posting($postingId, $postingProfileId, $postingRoleId, $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPosting = Posting::getPostingByPostingProfileId$this->getPDO(), $posting->getPostingId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertEquals($pdoPosting->getPostingId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingProfileId(), $postingProfileId);
		$this->assertEquals($pdoPosting->getPostingRoleId(), $postingRoleId);
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
	 *test postingRoleId from posting
	 */
	public function testValidPostingRoleId(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("posting");
		//create a new Posting and insert to into mySQL
		$postingId = generateUuidV4();
		$postingProfileId = generateUuidV4();
		$postingRoleId = generateUuidV4();
		$posting = new Posting($postingId, $postingProfileId, $postingRoleId, $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPosting = Posting::getPostingByPostingRoleId($this->getPDO(), $posting->getPostingId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertEquals($pdoPosting->getPostingId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingProfileId(), $postingProfileId);
		$this->assertEquals($pdoPosting->getPostingRoleId(), $postingRoleId);
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
		$postingProfileId = generateUuidV4();
		$postingRoleId = generateUuidV4();
		$posting = new Posting($postingId, $postingProfileId, $postingRoleId, $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
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
	 *test grabbing all Postings
	 */
	public function testGetALLValidPostings(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("posting");
		//create a new Posting and insert to into mySQL
		$postingId = generateUuidV4();
		$postingProfileId = generateUuidV4();
		$postingRoleId = generateUuidV4();
		$posting = new Posting($postingId, $postingProfileId, $postingRoleId, $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Posting::getAllPostings($this->getPDO(), $posting->getPostingContent());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("CareerBusters\\WebDevJobs\\Test", $results);
		// grad the results from a array and validate it
		$pdoPosting = $results[0];
		$this->assertEquals($pdoPosting->getPostingId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingProfileId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingRoleId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingCompany(), $this->VALID_POSTINGCOMPANYNAME);
		$this->assertEquals($pdoPosting->getPostingContent(), $this->VALID_POSTINGCONTENT);
		$this->assertEquals($pdoPosting->getPostingEmail(), $this->VALID_POSTINGEMAIL);
		$this->assertEquals($pdoPosting->getPostingLocation(), $this->VALID_POSTINGLOCATION);
		$this->assertEquals($pdoPosting->getPostingPay(), $this->VALID_POSTINGPAY);
		$this->assertEquals($pdoPosting->getPostingTitle(), $this->VALID_POSTINGTITLE);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoPosting->getPostingDate()->getTimestamp(), $this->VALID_POSTINGDATE->getTimestamp());
	}
}