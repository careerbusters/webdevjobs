<?php
namespace careerbusters\webdevjobs;;

use careerbusters\webdevjobs\{posting};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/classes/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

class postingTest extends DataDesignTest {

	protected $posting = null;


}