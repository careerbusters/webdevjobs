<?php
namespace CareerBusters\WebDevJobs;;
use CareerBusters\WebDevJobs\{posting};
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 *Full PHPUnit test for the Posting class
 */
class PostingTest extends DataDesignTest {
	/** Posting company name that created the Posting
	 * @var $postingCompanyName
	 */
	protected $postingCompanyName;
	/**
	 *posting content that created the Posting
	 *@var $postingContent
	 */
	protected $postingContent = "PHPUnit test passing";
	/**
	 timestamp of the posting
	 *@var \DateTime $postingDate
	 */
	protected $postingDate;
	/**
	posting email address of the person posting
	 *@var $postingEmail
	 */
	protected $postingEmail;
	/**
	timestamp of the posting
	 *@var \DateTime $postingEndDate
	 */
	protected $postingEndDate;
	/**
	posting location of the person posting
	 *@var $postingLocation
	 */
	protected $postingLocation;
	/**
	posting pay for the posting
	 *@var $postingPay
	 */
	protected $postingPay;
	/**
	posting title of the posting
	 *@var $postingTitle
	 */
	protected $postingTitle;
}
