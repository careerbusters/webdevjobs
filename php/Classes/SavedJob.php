<?php

namespace CareerBusters\WebDevJobs;
require_once ("autoload.php");
require_once(dirname(__DIR__, 1) . "/Classes/autoload.php");
use Ramsey\Uuid\Uuid;
/**
 * Cross Section of a Saved Job
 *
 * This is a cross section of what is probably stored about a saved job. This entity is an entity that
 * holds the keys to the other entities.
 *
 * @savedjob Natasha Lovato <nmarshlovato@cnm.edu>
 * @version 1.0.0
 **/
class SavedJob implements \JsonSerializable {
	use validateDate;
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
	 * @param string|Uuid $newSavedJobPostingId id of Saved Job or null if a new Saved Job.
	 * @param string $newSavedJobProfileId for profile id.
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data types values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @thorws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newSavedJobPostingId, $newSavedJobProfileId) {
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
	public function setSavedJobPostingId($newSavedJobPostingId): void {
		try {
			$uuid = self::ValidateUUid($newSavedJobPostingId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the saved job posting id
		$this->savedJobPostingId = $uuid;
	}
	/**
	 * Accessor method for saved job profile id
	 * @return string for savedJobProfileId
	 **/
	public function getSavedJobProfileId(): string {
		return ($this->savedJobProfileId);
	}
	/**
	 * mutator method for saved job profile id
	 *
	 * @param string $newSavedJobProfileId new value of saved job profile id
	 * @throws \RangeException if $newSavedJobProfileId is not positive
	 * @throws \TypeError if $newSavedJobProfileId is not a uuid or string
	 **/
	public function setSavedJobProfileId( $newSavedJobProfileId): void {
		try {
			$uuid = self::validateUuid($newSavedJobProfileId);
		} catch(\InvalidArgumentException | \RangeException |\Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the id content
		$this->savedJobProfileId = $uuid;

	}/**
	 *inserts into Saved Job Posting mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {
		// create query template
		$query = "INSERT INTO savedJob(savedJobPostingId, savedJobProfileId)
		VALUES(:savedJobPostingId, :savedJobProfileId)";
		$statement = $pdo->prepare($query);
		//bind the member variables to the place holders in the template
		$parameters = ["savedJobPostingId" => $this->savedJobPostingId->getBytes(), "savedJobProfileId" => $this->savedJobProfileId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 *deletes this Saved Job Posting from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {
		// create query template
		$query = "DELETE FROM savedJob WHERE savedJobPostingId = :savedJobPostingId && savedJobProfileId =:savedJobProfileId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holder in the template
		$parameters = ["savedJobPostingId" => $this->savedJobPostingId->getBytes(), "savedJobProfileId" => $this->savedJobProfileId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 * Updates this Saved Job Posting in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {
		//create query template
		$query = "UPDATE savedJob SET savedJobPostingId = :savedJobPostingId, savedJobProfileId = :savedJobProfileId WHERE savedJobPostingId = savedJobPostingId";
		$statement = $pdo->prepare($query);
		$parameters = ["savedJobPostingId" => $this->savedJobPostingId->getBytes(),$this->savedJobProfileId => $this->savedJobProfileId];
		$statement->execute(($parameters));
	}
	/**
	 * gets the savedJobPosting by savedJobPostingId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $savedJobPostingId savedJobPosting id to search for
	 * @return savedJob|null saved job found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getSavedJobBySavedJobPostingId(\PDO $pdo, $savedJobPostingId): savedJob {
		//sanitize the savedJobPostingId before searching
		try {
			$savedJobPostingId = self::validateUuid($savedJobPostingId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		//create query template
		$query = "SELECT savedJobPostingId, savedJobProfileId FROM savedJob WHERE savedJobPostingId = :savedJobPostingId";
		$statement = $pdo->prepare($query);
		//bind the saved job posting id to the place holder in the template
		$parameters = ["savedJobPostingId" => $savedJobPostingId->getBytes()];
		$statement->execute($parameters);
		//grab the savedJobPosting from mySQL
		try {
			$savedJobPostingId = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$savedJobPostingId = new savedJob($row["savedJobPostingId"], $row["savedJobProfileId"]);
			}
		} catch(\Exception $exception) {
			//if the row could't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($savedJobPostingId);
	}
	/**
	 * gets savedJob by saved job posting id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $savedJobProfileId saved job positing id to search by
	 * @return \SplFixedArray SplFixedArray of savedJobPosting found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getSavedJobBySavedJobProfileId(\PDO $pdo, $savedJobProfileId): savedJob {
		// sanitize the description before searching
		try {
			$savedJobProfileId = self::validateUuid($savedJobProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT savedJobPostingId, savedJobProfileId FROM savedJob WHERE savedJobProfileId LIKE :savedJobProfileId";
		$statement = $pdo->prepare($query);
		// bind the savedJobPosting id to the place holder in the template
		$parameters = ["savedJobProfileId" => $savedJobProfileId->getBytes()];
		$statement->execute($parameters);
		// build an array of authors
			try {
				$savedJobProfileId = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$savedJobProfileId = new savedJob($row["savedJobPostingId"], $row["savedJobProfileId"]);
				}
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		return ($savedJobProfileId);
	}


	/**
	 * gets the Saved Job by Saved Job posting id and Saved Job profile Id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $savedJobPostingId of savedJobs found
	 * @param Uuid|string $savedJobProfileId of savedJobs found
	 * @return SavedJob | null SavedJob found or null if not found
	 * @throws \PDOException when mySQL related error occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public static function getSavedJobBySavedJobPostingIdAndSavedJobProfileId(\PDO $pdo, $savedJobPostingId, $savedJobProfileId) : ?SavedJob {
		//Sanitize the savedJobPostingId and the savedJobProfileId before searching.
		try {
			$savedJobPostingId = self::validateUuid($savedJobPostingId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		try {
			$savedJobProfileId = self::validateUuid($savedJobProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		//Create the query template.
		$query = "SELECT savedJobPostingId, savedJobProfileId FROM savedJob WHERE savedJobPostingId = :savedJobPostingId AND savedJobProfileId = :savedJobProfileId";
		$statement = $pdo->prepare($query);
		//Bind the savedJobPostingId and the savedJobProfileId to the place holder in the template.
		$parameters = ["savedJobPostingId" => $savedJobPostingId->getBytes(), "savedJobProfileId" => $savedJobProfileId->getBytes()];
		$statement->execute($parameters);

		//Grab the savedJob from mySQL
		try {
			$savedJob = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$savedJob = new SavedJob($row["savedJobPostingId"], $row["savedJobProfileId"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($savedJob);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);
		$fields["saveJobPostingId"] = $this->savedJobPostingId->toString();
	}
}
