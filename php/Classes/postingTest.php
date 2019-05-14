<?php
namespace CareerBusters\WebDevJobs;;

use careerbusters\webdevjobs\{posting};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/Classes/validateUuid.php");

class postingTest extends DataDesignTest {

	protected $posting = null;


}