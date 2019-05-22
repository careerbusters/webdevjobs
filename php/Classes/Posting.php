<?php

namespace CareerBusters\WebDevJobs;

require_once(dirname(__DIR__) . "/vendor/autoload.php");
require_once("autoload.php");
use Ramsey\Uuid\Uuid;

use CareerBusters\WebDevJobs\Role;
use CareerBusters\WebDevJobs\profile;

/** create class for table Posting */



class Posting implements \JsonSerializable {
	use ValidateDate;
	use ValidateUuid;

	/**
	 * id for this posting; this is the primary key
	 * @var Uuid $postingId
	 **/
	private $postingId;
	/**
	 * id of the profile that posting the job; this is a foreign key
	 * @var Uuid $postingProfileId
	 */
	private $postingProfileId;
	/**
	 * id of the role that posting the job; this is a foreign key
	 * @var Uuid $postingRoleId
	 **/
	private $postingRoleId;
	/**
	 * actual company name of the posting
	 * @var string $postingCompanyName
	 **/
	private $postingCompanyName;
	/**
	 * actual text content of this posting
	 * @var string postingContent
	 **/
	private $postingContent;
	/**
	 * start date and time the posting began
	 * @var /DateTime $postingDate
	 **/
	private $postingDate;
	/**
	 * actual email address of the posting
	 * @var string postingEmail
	 **/
	private $postingEmail;
	/**
	 * date and time this posting will end
	 * @var /DateTime $postingEndDate
	 **/
	private $postingEndDate;
	/**
	 * location based on city of the posting
	 * @var string $postingLocation
	 **/
	private $postingLocation;
	/**
	 * actual pay of the posting
	 * @var string $postingPay
	 **/
	private $postingPay;
	/**
	 * actual tile of the posting
	 * @var string $postingTitle
	 **/
	private $postingTitle;

	/**
	 * constructor for this posting
	 *
	 * @param string/Uuid $newPostingId Id from posting
	 * @param string/Uuid $newPostingProfileId from profile
	 * @param string/Uuid $newPostingRoleId from role
	 * @param string $newPostingCompanyName Id from posting or postingContent
	 * @param string $newPostingContent will be associated to postingId or null if content was resubmitted
	 * @param /DateTime $newPostingDate date and time posting was started
	 * @param string $newPostingEmail when postingEmail is new or null if email is already on file
	 * @param /DateTime $newPostingEndDate date and time posting was ending
	 * @param string $newPostingLocation based on city and state of posting
	 * @param string $newPostingPay pay will be based on content or null if content was resubmitted
	 * @param string $newPostingTitle will be associated to postingId
	 * @throws /RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws /TypeError if data types violate type hints
	 * @throws   /Exception if some other exception occurs
	 *
	 */
	public function __construct($newPostingId, $newPostingProfileId, $newPostingRoleId, string $newPostingCompanyName, string $newPostingContent, $newPostingDate, string $newPostingEmail, $newPostingEndDate, string $newPostingLocation, string $newPostingPay, string $newPostingTitle) {
		try {
			$this->setPostingId($newPostingId);
			$this->setPostingProfileId($newPostingProfileId);
			$this->setPostingRoleId($newPostingRoleId);
			$this->setPostingCompanyName($newPostingCompanyName);
			$this->setPostingContent($newPostingContent);
			$this->setPostingDate($newPostingDate);
			$this->setPostingEmail($newPostingEmail);
			$this->setPostingEndDate($newPostingEndDate);
			$this->setPostingLocation($newPostingLocation);
			$this->setPostingPay($newPostingPay);
			$this->setPostingTitle($newPostingTitle);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for postingId
	 * @return Uuid value of postingId
	 **/
	public function getPostingId(): Uuid {
		return ($this->postingId);
	}

	/**
	 * mutator method for posting id
	 *
	 * @param string $newPostingId value of new posting id
	 * @throws \RangeException if $newPostingId is not positive
	 * @throws \TypeError if PostingId is not positive
	 **/
	public function setPostingId($newPostingId): void {
		try {
			$uuid = self::validateUuid($newPostingId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->postingId = $uuid;
	}

	/**
	 * accessor method for postingProfileId
	 *  @return string|Uuid for postingProfileId (or null if new Posting)
	 **/
	public function getPostingProfileId(): Uuid {
	return ($this->postingProfileId);
	}

	/**
	 * mutator method for posting profile id
	 *
	 * @param Uuid|string $newPostingProfileId value of new postingProfile id
	 * @throws \RangeException if $newPostingProfileId is not positive
	 * @throws \TypeError if PostingProfileId is not positive
	 **/
	public function setPostingProfileId($newPostingProfileId): void {
		try {
			$uuid = self::validateUuid($newPostingProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the postingProfile id
		$this->postingProfileId = $uuid;
	}

	/**
	 * accessor method for postingRoleId
	 *  @return string|Uuid for postingRoleId (or null if new Posting)
	 **/
	public function getPostingRoleId(): Uuid {
		return ($this->postingRoleId);
	}

	/**
	 * mutator method for postingRole id
	 *
	 * @param string $newPostingRoleId value of new PostingRole id
	 * @throws \RangeException if $newPostingRoleId is not positive
	 * @throws \TypeError if PostingRoleId is not positive
	 **/
	public function setPostingRoleId($newPostingRoleId): void {
		try {
			$uuid = self::validateUuid($newPostingRoleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the postingRole id
		$this->postingRoleId = $uuid;
	}

	/**
	 * accessor method for postingCompanyName
	 * @return string value of postingCompanyName
	 **/
	public function getPostingCompanyName(): string {
		return ($this->postingCompanyName);
	}

	/**
	 * mutator method for posting company name
	 * @param string $newPostingCompanyName new value of posting company name
	 * @throws \typeError if $newPostingCompanyName is not a string
	 **/
	public function setPostingCompanyName($newPostingCompanyName): void {
		$newPostingCompanyName = trim($newPostingCompanyName);
		$newPostingCompanyName = filter_var($newPostingCompanyName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPostingCompanyName) === true) {
			throw(new \InvalidArgumentException("company name is empty"));
		}
		// store the content
		$this->postingCompanyName = $newPostingCompanyName;
	}

	/**
	 * accessor method for postingContent
	 * @return string value of postingContent
	 **/
	public function getPostingContent(): string {
		return ($this->postingContent);
	}

	/**
	 * mutator method for postingContent
	 * @param string $newPostingContent new value of posting content
	 * @throws \TypeError if $newPostingContent is not a string
	 * @throws \RangeException if $newProfileBio is over charset
	 **/
	public function setPostingContent($newPostingContent): void {
		$newPostingContent = trim($newPostingContent);
		$newPostingContent = filter_var($newPostingContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPostingContent) === true) {
			throw(new \InvalidArgumentException("posting content is empty or insecure"));
		}


		// verify the posting content will fit in the database
		if(strlen($newPostingContent) > 30000) {
			throw(new \RangeException("posting content too large"));
		}
		// store the content
		$this->postingContent = $newPostingContent;
	}

	/**
	 * accessor method for posting date
	 * @return \DateTime value of posting date
	 **/
	public function getPostingDate(): \DateTime {
		return ($this->postingDate);
	}

	/**
	 * mutator method for posting date
	 * @param \DateTime|string|null $newPostingDate date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newPostingDate is not a valid object or string
	 * @throws \RangeException if $newPostingDate is a date that does not exist
	 * @throws  \typeError if $eventStartTime is no a /Datetime
	 **/
	public function setPostingDate($newPostingDate = null): void {
		// base case: if the date is null, use the current date and time
		if($newPostingDate === null) {
			$this->postingDate = new \DateTime();
			return;
		}

		// store the date using the ValidateDateTime trait
		try {
			$newPostingDate = self::validateDateTime($newPostingDate);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->postingDate = $newPostingDate;
	}

	/**
	 * accessor method for posting email
	 * @return string value of posting email
	 **/
	public function getPostingEmail(): string {
		return ($this->postingEmail);
	}

	/**
	 * mutator method for posting email
	 * @param string $newPostingEmail new value of posting email
	 * @throws \typeError if $newPostingEmail is not a string
	 **/
	public function setPostingEmail($newPostingEmail): void {
		$newPostingEmail = trim($newPostingEmail);
		$newPostingEmail = filter_var($newPostingEmail, FILTER_SANITIZE_EMAIL);
		if(empty($newPostingEmail) === true) {
			throw(new \InvalidArgumentException("posting email is empty"));
		}
		// store the email content
		$this->postingEmail = $newPostingEmail;
	}

	/**
	 * accessor method for posting end date
	 * @return \DateTime value of posting end date
	 **/
	public function getPostingEndDate(): \DateTime {
		return ($this->postingEndDate);
	}

	/**
	 * mutator method for posting end date
	 * @param \DateTime|string|null $newPostingEndDate date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newPostingEndDate is not a valid object or string
	 * @throws \RangeException if $newPostingEndDate is a date that does not exist
	 *  * @throws  \typeError if $eventStartTime is no a /Datetime
	 **/
	public function setPostingEndDate($newPostingEndDate): void {
		// base case: if the date is null, use the current date and time
		if($newPostingEndDate === null) {
			$this->postingDate = new \DateTime();
			return;
		}
		// store the like date using the validateDateTime trait
		try {
			$newPostingEndDate = self::validateDateTime($newPostingEndDate);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->postingEndDate = $newPostingEndDate;
	}

	/**
	 * accessor method for postingLocation
	 * @return string value of postingLocation
	 **/
	public function getPostingLocation(): string {
		return ($this->postingLocation);
	}

	/**
	 * mutator method for posting location
	 * @param string $newPostingLocation new value of posting location
	 * @throws \typeError if $newPostingLocation is not a string
	 **/
	public function setPostingLocation($newPostingLocation): void {
		$newPostingLocation = trim($newPostingLocation);
		$newPostingLocation = filter_var($newPostingLocation, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPostingLocation) === true) {
			throw(new \InvalidArgumentException("posting location isn't in Albuquerque"));
		}
		// store the location
		$this->postingLocation = $newPostingLocation;
	}

	/**
	 * accessor method for postingPay
	 * @return string value of postingPay
	 **/
	public function getPostingPay(): string {
		return ($this->postingPay);
	}

	/**
	 * mutator method for posting pay
	 * @param string $newPostingPay new value of posting pay
	 * @throws \typeError if $newPostingPay is not a string
	 **/
	public function setPostingPay($newPostingPay): void {
		$newPostingPay = trim($newPostingPay);
		$newPostingPay = filter_var($newPostingPay, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPostingPay) === true) {
			throw(new \InvalidArgumentException("how much the job pays is missing"));
		}
		// store the pay
		$this->postingPay = $newPostingPay;
	}

	/**
	 * /**
	 * accessor method for postingTitle
	 * @return string value of postingTitle
	 **/
	public function getPostingTitle(): string {
		return ($this->postingTitle);
	}

	/**
	 * mutator method for posting title
	 * @param string $newPostingTitle new value of posting title
	 * @throws \typeError if $newPostingTitle is not a string
	 **/
	public function setPostingTitle($newPostingTitle): void {
		$newPostingTitle = trim($newPostingTitle);
		$newPostingTitle = filter_var($newPostingTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPostingTitle) === true) {
			throw(new \InvalidArgumentException("job title is missing"));
		}
		// store the title
		$this->postingTitle = $newPostingTitle;
	}

	/**
	 *inserts this posting into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws |\TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo): void {
		// create query template
		$query = "INSERT INTO posting(postingId, postingProfileId, postingRoleId, postingCompanyName, postingContent, postingDate, postingEmail, postingEndDate, postingLocation, postingPay, postingTitle) 
VALUES(:postingId, :postingProfileId, :postingRoleId, :postingCompanyName, :postingContent, :postingDate, :postingEmail, :postingEndDate, :postingLocation, :postingPay, :postingTitle )";
		$statement = $pdo->prepare($query);
		// bind the member variable to the place holders in the template
		$formattedDate = $this->postingDate->format("Y-m-d H:i:s.u");
		$parameters = ["postingId" => $this->postingId->getBytes(), "postingProfileId" => $this->postingProfileId->getBytes(), "postingRoleId" => $this->postingRoleId->getBytes(), "postingCompanyName" => $this->postingCompanyName, "postingContent" => $this->postingContent, "postingEmail" => $this->postingEmail, "postingLocation" => $this->postingLocation, "postingTitle" => $this->postingTitle, "postingPay" => $this->postingPay, "postingDate" => $formattedDate, "postingEndDate" => $formattedDate];
		$statement->execute($parameters);
	}

	/**
	 * updates this posting in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {

		// create query template
		$query = "UPDATE posting SET postingProfileId = :postingProfileId, postingRoleId = :postingRoleId, postingCompanyName = :postingCompanyName, postingContent = :postingContent, postingDate = :postingDate, postingEmail = :postingEmail, postingEndDate = :postingEndDate, postingLocation = :postingLocation, postingPay = :postingPay, postingTitle = :postingTitle  WHERE postingId = :postingId";
		$statement = $pdo->prepare($query);

		$formattedDate = $this->postingDate->format("Y-m-d H:i:s.u");
		$parameters = ["postingId" => $this->postingId->getBytes(), "postingContent" => $this->postingContent, "postingDate" => $formattedDate];
		$statement->execute($parameters);
	}

	/**
	 * deletes this posting from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {
		// create query template
		$query = "DELETE FROM posting WHERE postingId = :postingId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holder in the template
		$parameters = ["postingId" => $this->postingId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 * gets the posting by postingId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $postingId posting id to search by
	 * @return posting|null posting found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getPostingByPostingId(\PDO $pdo, $postingId): ?posting {
		try {
			$postingId = self::validateUuid($postingId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT postingId, postingProfileId, postingRoleId, postingCompanyName, postingContent, postingDate, postingEmail, postingEndDate, postingLocation, postingPay, postingTitle from posting where postingId = :postingId";
		$statement = $pdo->prepare($query);
		// bind the profile id to the place holder in the template
		$parameters = ["postingId" => $postingId->getBytes()];
		$statement->execute($parameters);

		// grad the posting from mySQL
			try {
				$posting = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$posting = new Posting($row["postingId"], $row["postingProfileId"], $row["postingRoleId"], $row["postingCompanyName"], $row["postingContent"], $row["postingDate"], $row["postingEmail"], $row["postingEndDate"], $row["postingLocation"], $row["postingPay"], $row["postingTitle"]);
				}
				} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		return ($posting);
	}

	/**
	 * gets the posting by postingProfileId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $postingProfileId posting id to search by
	 * @return posting|null posting found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getPostingByPostingProfileId(\PDO $pdo, $postingProfileId): \SplFixedArray {

		try {
			$postingProfileId = self::validateUuid($postingProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT postingId, postingProfileId, postingRoleId, postingCompanyName, postingContent, postingDate, postingEmail, postingEndDate, postingLocation, postingPay, postingTitle from posting where postingProfileId = :postingProfileId";
		$statement = $pdo->prepare($query);
		$parameters = ["postingProfileId" => $postingProfileId->getBytes()];
		$statement->execute($parameters);
		// build an array of posting
		$postings = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$posting = new posting($row["postingId"], $row["postingProfileId"], $row["postingRoleId"], $row["postingCompanyName"], $row["postingContent"], $row["postingDate"], $row["postingEmail"], $row["postingEndDate"], $row["postingLocation"], $row["postingPay"], $row["postingTitle"]);
				$postings[$postings->key()] = $posting;
				$postings->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($postings);
	}

	/**
	 * gets the posting by postingRoleId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $postingRoleId posting id to search for
	 *  @return posting|null posting found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getPostingByPostingRoleId(\PDO $pdo, $postingRoleId): \SplFixedArray {

		// sanitize the todoId before searching
		// sanitize the postingId before searching
		try {
			$postingRoleId = self::validateUuid($postingRoleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT postingId, postingProfileId, postingRoleId, postingCompanyName, postingContent, postingDate, postingEmail, postingEndDate, postingLocation, postingPay, postingTitle from posting where postingRoleId = :postingRoleId";
		$statement = $pdo->prepare($query);
		// bind the posting role id to the place holder in the template
		$parameters = ["postingRoleId" => $postingRoleId->getBytes()];
		$statement->execute($parameters);
		// build an array of posting
		$postings = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$posting = new posting($row["postingId"], $row["postingProfileId"], $row["postingRoleId"], $row["postingCompanyName"], $row["postingContent"], $row["postingDate"], $row["postingEmail"], $row["postingEndDate"], $row["postingLocation"], $row["postingPay"], $row["postingTitle"]);
				$postings[$postings->key()] = $posting;
				$postings->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($postings);
	}

	/**
	 * gets all postings
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of postings found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllPostings(\PDO $pdo): \SPLFixedArray {
		// create query template
		$query = "SELECT postingId, postingProfileId, postingRoleId, postingCompanyName, postingContent, postingDate, postingEmail, postingEndDate, postingLocation, postingPay, postingTitle FROM posting";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of postings
		$postings = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$posting = new posting($row["postingId"], $row["postingProfileId"], $row["postingRoleId"], $row["postingCompanyName"], $row["postingContent"], $row["postingDate"], $row["postingEmail"], $row["postingEndDate"], $row["postingLocation"], $row["postingPay"], $row["postingTitle"]);
				$postings[$postings->key()] = $posting;
				$postings->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($postings);
	}
/**
 * formats the state variables for JSON serialization
 *
 * @return array resulting state variables to serialize
 **/
public function jsonSerialize() : array {
	$fields = get_object_vars($this);
	$fields["postingId"] = $this->postingId->toString();
	$fields["postingProfileId"] = $this->postingProfileId->toString();
	$fields["postingRoleId"] = $this->postingRoleId->toString();
	return ($fields);
}}