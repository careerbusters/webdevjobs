<?php
namespace careerbusters\webdevjobs;
require_once(dirname(__DIR__) . "/classes/autoload.php");

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
class savedJob implements \JsonSerializable {
	use ValidateDate;
	use ValidateUuid;
/**
 * id and savedJob (foreign key)
 * @var string Uuid $savedJobId
 **/
protected $savedJobId;
/**
 * profileId and savedJob (foreign key)
 * @var $savedJobProfileId
 **/
protected $savedJobProfileId;

/**
 * Constructor for Saved Job
 * @param string|Uuid $savedJobId id of Saved Job or null if a new Saved Job.
 * @param string $savedJobProfileId for profile id.
 * @throws \InvalidArgumentException if data types are not valid
 * @throws \RangeException if data types values are out of bounds (e.g., strings too long, negative integers)
 * @throws \TypeError if data types violate type hints
 * @thorws \Exception if some other exception occurs
 * @Documentation https://php.net/manual/en/language.oop5.decon.php
 **/
	/**
	 * @return string
	 */
	public function __construct($savedJobId, string $savedJobProfileId = null) {
	try {
		$this->setSavedJobId($savedJobId);
		$this->savedJobProfileId($savedJobProfileId);
	}
	//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
}

/**
 * mutator method for saved job id
 *
 * @param string $savedJobId value of saved job id
 * @throws \RangeExceptionif $savedJobId is not positive
 * @throws \TypeError if saved job is is not positive
 **/
public function setSavedJobId($savedJobId): void {
	try {
		$Uuid = self::ValidateUUid($savedJobId);
	} catch()
}
