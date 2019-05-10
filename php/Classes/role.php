<?php
namespace careerbusters\webdevjobs;
require_once(dirname(__DIR__) . "/classes/autoload.php");

use http\Exception\BadUrlException;
use Ramsey\Uuid\Uuid;
use tgray19\webdevjobs\ValidateDate;
use tgray19\webdevjobs\ValidateUuid;

/**
 * Cross Section of a Saved Job
 *
 * This is a cross section of what is probably stored about a saved job. This entity is an entity that
 * holds the keys to the other entities.
 *
 * @savedjob Natasha Lovato <nmarshlovato@cnm.edu>
 * @version 1.0.0
 **/
class savedJobPosting implement \JsonSerializable; {
	use ValidateDate;
	use ValidateUuid;