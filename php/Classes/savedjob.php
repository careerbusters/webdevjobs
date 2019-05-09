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
class savedJobPosting implements \JsonSerializable {
	use ValidateDate;
	use ValidateUuid;
/**
 * id and savedJob (foreign key)
 * @var string Uuid $savedJobId
 **/
protected $savedJobPostingId;
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
	public function __construct($savedJobPostingId, string $savedJobProfileId = null) {
	try {
		$this->setSavedJobPostingId($savedJobPostingId);
		$this->setSavedJobProfileId($savedJobProfileId);
	}
	//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

/**
 * mutator method for saved job id
 *
 * @param string $savedJobPostingId value of saved job posting id
 * @throws \RangeException if $savedJobPostingId is not positive
 * @throws \TypeError if saved job posting id is not positive
 **/
public function setSavedJobId($savedJobPostingId): void {
	try {
		$Uuid = self::ValidateUUid($savedJobPostingId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}

	// convert and store the saved job posting id
	$this->savedJobPostingId = $Uuid;
}

/**
 * Accessor method for saved job profile id
 *
 * @param string $savedJobProfileId value of new saved job profile id
 * @throws \InvalidArgumentException if $savedProfileId is not a valid profile id or insecure
 * @throws \RangeException if $savedJobProfileId is over charset
 * @throws \TypeError if saved job profile id is not a string
 **/
public function setSavedJobProfileId(): ?string {
	return ($this->savedJobProfileId);
}

/**
 * mutator method for saved job profile id
 *
 * @param string $savedJobProfileId value of saved job profile id
 * @throws \InvalidArgumentException if $savedJobProfileId is not valid or secure
 * @throws \RangeException if $savedJobProfileId is over charset
 * @throws \TypeError if saved job profile id is not a string
 **/
public function setSavedJobProfileId(?string $savedJobProfileId): void {
	//verify saved job profile id is secure
	$savedJobProfileId = trim($savedJobProfileId);
	$savedJobProfileId =filter_var($savedJobProfileId, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if (empty($savedJobProfileId) === true) {
		throw(new \InvalidArgumentException("saved profile id invalid or insecure"));
	}
}

}
