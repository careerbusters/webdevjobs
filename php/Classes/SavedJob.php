<?php
namespace CareerBusters\WebDevJobs;
require_once(dirname(__DIR__) . "/Classes/autoload.php");
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
	public function __construct($newSavedJobPostingId, $newSavedJobProfileId = null) {
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
		$this->$newSavedJobProfileId = $uuid;
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
		$query = "INSERT INTO savedJob(savedJobPostingId, savedJobProfileId)
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
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {
		// create query template
		$query = "DELETE FROM savedJob WHERE savedJobPostingId = :savedJobPostingId";
		$statement = $pdo->prepare($query);
		// bind the memeber variables to the place holder in the template
		$parameters = ["savedJobPostingId" => $this->savedJobPostingId->getBytes()];
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
				$savedJobPostingId = new savedJob($row["savedJobPostingId"], $row["savedJobPostingId"]);
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
	 * @param Uuid|string $savedJobPostingId saved job positing id to search by
	 * @return \SplFixedArray SplFixedArray of savedJobPosting found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getSavedJobBySavedJobProfileId(\PDO $pdo, $savedJobProfileId): \SplFixedArray {
		// sanitize the description before searching
		$savedJobs = trim($savedJobProfileId);
		$savedJobs = filter_var($savedJobs, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($savedJobs) === true) {
			throw(new \PDOException("saved job posting is invalid"));
		}
		// create query template
		$query = "SELECT savedJobPostingId, savedJobProfileId FROM savedJob WHERE savedJobProfileId LIKE :savedJobProfileId";
		$statement = $pdo->prepare($query);
		// bind the savedJobPosting id to the place holder in the template
		$savedJobProfileId="%savedJobProfileId%";
		$parameters = ["savedProfileId" => $savedJobProfileId];
		$statement->execute($parameters);
		// build an array of authors
		$savedJobPostings = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$savedJobPosting = new savedJob($row["savedJobPostingId"], $row["savedJobProfileId"]);
				$savedJobPostings[$savedJobPosting->key()] = $savedJobPosting;
				$savedJobPostings->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($savedJobPostings);
	}
	//TODO getSavedJobBySavedJobPostingIdAndSavedJobProfileId
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
