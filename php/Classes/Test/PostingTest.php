<?php
namespace CareerBusters\WebDevJobs;;
use CareerBusters\WebDevJobs\{posting};
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/ValidateUuid.php");

/**
 *Full PHPUnit test for the Posting class
 */
class PostingTest extends DataDesignTest {
	/** Posting that created the 
	 *
	 */
	protected $posting = null;

}
