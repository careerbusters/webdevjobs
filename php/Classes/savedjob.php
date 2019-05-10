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
 * @param string|Uuid $newSavedJobId id of Saved Job or null if a new Saved Job.
 * @param string $newSavedJobProfileId for profile id.
 * @throws \InvalidArgumentException if data types are not valid
 * @throws \RangeException if data types values are out of bounds (e.g., strings too long, negative integers)
 * @throws \TypeError if data types violate type hints
 * @thorws \Exception if some other exception occurs
 * @Documentation https://php.net/manual/en/language.oop5.decon.php
 **/
	public function __construct($newSavedJobPostingId, string $newSavedJobProfileId = null) {
	try {
		$this->setSavedJobPostingId($newSavedJobPostingId);
		$this->setSavedJobProfileId($newSavedJobProfileId);
	}
	//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

/**
*Accessor method for savedJobPostingId
* @return string|Uuid for savedJobPostingId (or null if new Profile)
**/
	/**
	 * @return string
	 */
	public function getSavedJobPostingId() {
		return $this->savedJobPostingId;
	}

/**
 * mutator method for saved job posting id
 *
 * @param string $newSavedJobPostingId value of saved job posting id
 * @throws \RangeException if $savedJobPostingId is not positive
 * @throws \TypeError if saved job posting id is not positive
 **/
public function setSavedJobId($newSavedJobPostingId): void {
	try {
		$Uuid = self::ValidateUUid($newSavedJobPostingId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}

	// convert and store the saved job posting id
	$this->savedJobPostingId = $Uuid;
}

/**
 * Accessor method for saved job profile id
 * @return string for savedJobProfileId
 **/
public function setSavedJobProfileId(): ?string {
	return ($this->savedJobProfileId);
}

/**
 * mutator method for saved job profile id
 *
 * @param string $newSavedJobProfileId value of saved job profile id
 * @throws \InvalidArgumentException if $savedJobProfileId is not valid or secure
 * @throws \RangeException if $savedJobProfileId is over charset
 * @throws \TypeError if saved job profile id is not a string
 **/
public function setSavedJobProfileId(?string $newSavedJobProfileId): void {
	//verify the email is secure
	$newSavedJobProfileId = trim($newSavedJobProfileId);
	$newSavedJobProfileId =filter_var($newSavedJobProfileId, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if (empty($newSavedJobProfileId) === true) {
		throw(new \InvalidArgumentException("saved profile id invalid or insecure"));
	}

	//verify the email content  will fit in the database
	if(strlen($newSavedJobProfileId) > 128) {
		throw(new\RangeException("profile email is too large"));
	}
	// store the email content
		$this->$newSavedJobProfileId = $newSavedJobProfileId;
}

/**
 * Accessor method for savedjobprofileid
 * @return string for savedjobprofileid
 **/
public function getSavedJobProfileId(): ?string {
	return ($this->savedJobProfileId);
	}

/**
 *inserts into Saved Job Posting mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function insert(\PDO $pdo): void {
	// create query template
	$query = "INSERT INTO savedJobPosting(savedJobPostingId, ssvedJobProfileId)
		VALUES(:savedJobPostingId, :savedJobProfileId)";
	$statement = $pdo->prepare($query);

	//bind the member variables to the place holders in the temolate
		$parameters = ["savedJobPostingId" => $this->savedJobPostingId->getBytes(), "savedJobProfileId" => $this->savedJobProfileId];
		$statement->execute($parameters);
	}

/**
 *deletes this Saved Job Posting from mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeErrorif $pdo is not a PDO connection object
 **/
pugblic function delete(\PDO $pdo): void {

	// create query template
	$query = "DELETE FROM savedJobPosting WHERE savedJobPostingId = :savedJobPostingId";
	$statement = $pdo->prepare($query);

	// bind the memeber variables to the place holder in the template
	$parameters = ["savedJobPostingId" => $this->savedJobPostingId->getBytes()];
	$statement->execute($parameters);
	}

/**
 * Updates this Saved Job Posting in mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOExceptionwhe mySql related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function update(\PDO $pdo): void {

	//create query template
	$query = "UPDATE savedJobPosting SET savedJobPostingId = :"
	}

}
