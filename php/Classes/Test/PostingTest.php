<?php
namespace CareerBusters\WebDevJobs\Test;
use CareerBusters\WebDevJobs\Posting;
use CareerBusters\WebDevJobs\Profile;
use CareerBusters\WebDevJobs\Role;

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");
/**
 *Full PHPUnit test for the Posting class
 */
class PostingTest extends WebDevJobsTest {
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
	protected $VALID_POSTINGCOMPANYNAME = "Bob tech";
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
	protected $VALID_POSTINGEMAIL = "test@phpuit.ey";
	/**
	 * timestamp of the posting
	 * @var \DateTime $VALID_POSTINGENDDATE
	 */
	protected $VALID_POSTINGENDDATE = null;
	/**
	 * posting location of the posting
	 * @var $VALID_POSTINGLOCATION
	 */
	protected $VALID_POSTINGLOCATION = "Albuquerque";
	/**
	 * posting pay for the posting
	 * @var $VALID_POSTINGPAY
	 */
	protected $VALID_POSTINGPAY = "$25,000";
	/**
	 * posting title of the posting
	 * @var $VALID_POSTINGTITLE
	 */
	protected $VALID_POSTINGTITLE = "Freelancer";
	/**
	 * create dependent objects before running each test
	 */
	public final function setUp(): void {
// run the default setUp() method first
		parent::setup();
		//
		$password = "abc123";
		$hash = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$activation = bin2hex(random_bytes(16));
		// create and insert a mocked Profile
		$this->role = new Role(generateUuidV4(),"recruiter");
		$this->role->insert($this->getPDO());
		$this->profile = new Profile(generateUuidV4(), $this->role->getRoleId(), $activation, "i code stuff", "test@phpuit.ey", $hash, "http://placemorty.us/300/200", "Albuquerque", "bobbyjohn");
		$this->profile->insert($this->getPDO());
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
		$posting = new Posting($postingId, $this->profile->getProfileId(), $this->role->getRoleId(), $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPosting = Posting::getPostingByPostingId($this->getPDO(), $posting->getPostingId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertEquals($pdoPosting->getPostingId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoPosting->getPostingRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoPosting->getPostingCompanyName(), $this->VALID_POSTINGCOMPANYNAME);
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
		$posting = new Posting($postingId, $this->profile->getProfileId(), $this->role->getRoleId(), $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());
		$results = Posting::getPostingByPostingProfileId($this->getPDO(), $this->profile->getProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("CareerBusters\\WebDevJobs\\Posting", $results);
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPosting = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertEquals($pdoPosting->getPostingId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingProfileId(),  $this->profile->getProfileId());
		$this->assertEquals($pdoPosting->getPostingRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoPosting->getPostingCompanyName(), $this->VALID_POSTINGCOMPANYNAME);
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
	public function testValidPostingByPostingRoleId(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("posting");
		//create a new Posting and insert to into mySQL
		$postingId = generateUuidV4();
		$posting = new Posting($postingId, $this->profile->getProfileId(), $this->role->getRoleId(), $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());
		$results = Posting::getPostingByPostingRoleId($this->getPDO(), $this->role->getRoleId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("CareerBusters\\WebDevJobs\\Posting", $results);
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPosting = $results[0];
		// grab the data from mySQL and enforce the fields match our expectations
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertEquals($pdoPosting->getPostingId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingProfileId(),  $this->profile->getProfileId());
		$this->assertEquals($pdoPosting->getPostingRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoPosting->getPostingCompanyName(), $this->VALID_POSTINGCOMPANYNAME);
		$this->assertEquals($pdoPosting->getPostingContent(), $this->VALID_POSTINGCONTENT);
		$this->assertEquals($pdoPosting->getPostingEmail(), $this->VALID_POSTINGEMAIL);
		$this->assertEquals($pdoPosting->getPostingLocation(), $this->VALID_POSTINGLOCATION);
		$this->assertEquals($pdoPosting->getPostingPay(), $this->VALID_POSTINGPAY);
		$this->assertEquals($pdoPosting->getPostingTitle(), $this->VALID_POSTINGTITLE);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoPosting->getPostingDate()->getTimestamp(), $this->VALID_POSTINGDATE->getTimestamp());;
	}
	/**
	 * test creating a Posting and then deleting it
	 */
	public function testDeleteValidPosting(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("posting");
		//create a new Posting and insert to into mySQL
		$postingId = generateUuidV4();
		$posting = new Posting($postingId, $this->profile->getProfileId(), $this->role->getRoleId(), $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
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
	public function testGetAllValidPostings(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("posting");
		//create a new Posting and insert to into mySQL
		$postingId = generateUuidV4();
		$posting = new Posting($postingId, $this->profile->getProfileId(), $this->role->getRoleId(), $this->VALID_POSTINGCOMPANYNAME, $this->VALID_POSTINGCONTENT, $this->VALID_POSTINGDATE, $this->VALID_POSTINGEMAIL, $this->VALID_POSTINGENDDATE, $this->VALID_POSTINGLOCATION, $this->VALID_POSTINGPAY, $this->VALID_POSTINGTITLE);
		$posting->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Posting::getAllPostings($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("posting"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("CareerBusters\\WebDevJobs\\Posting", $results);
		// grad the results from a array and validate it
		$pdoPosting = $results[0];
		$this->assertEquals($pdoPosting->getPostingId(), $postingId);
		$this->assertEquals($pdoPosting->getPostingProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoPosting->getPostingRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoPosting->getPostingCompanyName(), $this->VALID_POSTINGCOMPANYNAME);
		$this->assertEquals($pdoPosting->getPostingContent(), $this->VALID_POSTINGCONTENT);
		$this->assertEquals($pdoPosting->getPostingEmail(), $this->VALID_POSTINGEMAIL);
		$this->assertEquals($pdoPosting->getPostingLocation(), $this->VALID_POSTINGLOCATION);
		$this->assertEquals($pdoPosting->getPostingPay(), $this->VALID_POSTINGPAY);
		$this->assertEquals($pdoPosting->getPostingTitle(), $this->VALID_POSTINGTITLE);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoPosting->getPostingDate()->getTimestamp(), $this->VALID_POSTINGDATE->getTimestamp());
	}
}