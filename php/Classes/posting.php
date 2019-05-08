<?php

namespace tgray19\webdevjobs;
require_once(dirname(__DIR__) . "/Classes/autoload.php");
use Ramsey\Uuid\Uuid;

/** create class for table posting */



class Posting implements \JsonSerializable {
	use validateDate;
	use validateUuid;

	/**
	 * id for this Posting; this is the primary key
	 * @var Uuid $postingId
	 **/
	private $postingId;
	/**
	 * actual text content of this Posting
	 * @var string postingContent
	 **/
	private $postingContent;
	/**
	 * actual email address of the Posting
	 * @var string postingEmail
	 **/
	private $postingEmail;
	/**
	 * location based on city and state of the Posting
	 * @var string $postingLocation
	 **/
	private $postingLocation;
	/**
	 * actual tile of the Posting
	 * @var string $postingTitle
	 **/
	private $postingTitle;
	/**
	 * actual pay of the Posting
	 * @var string $postingPay
	 **/
	private $postingPay;
	/**
	 * actual company name of the Posting
	 * @var string $postingCompanyName
	 **/
	private $postingCompanyName;
	/**
	 * start date and time the Posting began
	 * @var /DateTime $postingDate
	 **/
	private $postingDate;
	/**
	 * date and time this Posting will end
	 * @var /DateTime $postingEndDate
	 **/
	private $postingEndDate;
	/**
	 * actual role of the Posting
	 * @var string $postingRole
	 **/
	private $postingRole;

	/**
	 * constructor for this Posting
	 *
	 * @param string/Uuid $newPostingId Id from Posting
	 * @param string $newPostingContent will be associated to postingId or null if content was resubmitted
	 * @param string $newPostingEmail when postingEmail is new or null if email is already on file
	 * @param string $newPostingLocation based on city and state of Posting
	 * @param string $newPostingTitle will be associated to postingId
	 * @param string $newPostingPay pay will be based on content or null if content was resubmitted
	 * @param string $newPostingCompanyName Id from posting or postingContent
	 * @param /DateTime $newPostingDate date and time Posting was started
	 * @param /DateTime $newPostingEndDate date and time Posting was ending
	 * @param string $newPostingRole will be associated to postingId or null if role was resubmitted with previous content
	 * @throws /RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws /TypeError if data types violate type hints
	 * @throws   /Exception if some other exception occurs
	 *
	 */
	public function __construct($newPostingId, string $newPostingContent, string $newPostingEmail, string $newPostingLocation, string $newPostingTitle, $newPostingPay, string $newPostingCompanyName, $newPostingDate, $newPostingEndDate, string $newPostingRole = null) {
		try {
			$this->setPostingId($newPostingId);
			$this->setPostingContent($newPostingContent);
			$this->setPostingEmail($newPostingEmail);
			$this->setPostingLocation($newPostingLocation);
			$this->setPostingTitle($newPostingTitle);
			$this->setPostingPay($newPostingPay);
			$this->setPostingCompanyName($newPostingCompanyName);
			$this->setPostingDate($newPostingDate);
			$this->setPostingEndDate($newPostingEndDate);
			$this->setPostingRole($newPostingRole);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for posting id
	 * @return Uuid value of posting id
	 **/
	public function getPostingId(): Uuid {
		return ($this->postingId);
	}

	/**
	 * mutator method for posting id
	 *
	 * @param Uuid|string $newPostingId new value of posting id
	 * @throws \RangeException if $newPostingId is not positive
	 * @throws \TypeError if $newPostingId is not a uuid or string
	 **/
	public function setPostingId($newPostingId): void {
		try {
			$uuid = self::validateUuid($newPostingId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for posting content
	 * @return string value of posting content
	 **/
	public function getPostingContent(): string {
		return ($this->postingContent);
	}

	/**
	 * mutator method for posting content
	 * @param string $newPostingContent new value of posting content
	 * @throws \TypeError if $newPostingContent is not a string
	 **/
	public function setPostingContent($newPostingContent): void {
		$newPostingContent = trim($newPostingContent);
		$newPostingContent = filter_var($newPostingContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPostingContent) === true) {
			throw(new \InvalidArgumentException("posting content is empty or insecure"));
		}


		// verify the posting content will fit in the database
		if(strlen($newPostingContent) > 65535) {
			throw(new \RangeException("posting content too large"));
		}
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
	}
	/**
	 * accessor method for posting location
	 * @return string value of posting location
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
			throw(new \InvalidArgumentException("posting location isn't in New Mexico"));
		}
	}
	/**
	 * accessor method for posting title
	 * @return string value of posting title
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
		}}
	/**
	 * accessor method for posting pay
	 * @return string value of posting title
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
			throw(new \InvalidArgumentException("how much job pays is missing"));
		}}
	/**
	 * accessor method for posting company name
	 * @return string value of posting company name
	 **/
	public function getPostingCompanyName(): string {
		return ($this->postingCompanyName);
	}

	/**
	 * mutator method for Posting company name
	 * @param string $newPostingCompanyName new value of Posting company name
	 * @throws \typeError if $newPostingCompanyName is not a string

	 **/
	public function setPostingCompanyName($newPostingCompanyName): void {
		$newPostingCompanyName = trim($newPostingCompanyName);
		$newPostingCompanyName = filter_var($newPostingCompanyName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPostingCompanyName) === true) {
			throw(new \InvalidArgumentException("company name is empty"));
		}}
	/**
	 * accessor method for posting date
	 * @return \DateTime value of posting date
	 **/
	public function getPostingDate() : \DateTime {
		return($this->postingDate);
	}

	/**
	 * mutator method for posting date
	 * @param \DateTime|string|null $newPostingDate date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newPostingDate is not a valid object or string
	 * @throws \RangeException if $newPostingDate is a date that does not exist
	 **/
	public function setPostingDate($newPostingDate = null) : void {
		// base case: if the date is null, use the current date and time
		if($newPostingDate === null) {
			$this->postingDate = new \DateTime();
			return;
		}

		// store the like date using the ValidateDate trait
		try {
			$newPostingDate = self::validateDateTime($newPostingDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->postingDate = $newPostingDate;
	}
	/**
	 * accessor method for posting end date
	 * @return \DateTime value of posting end date
	 **/
	public function getPostingEndDate() : \DateTime {
		return($this->postingEndDate);
	}
	/**
	 * mutator method for posting end date
	 * @param \DateTime|string|null $newPostingEndDate date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newPostingEndDate is not a valid object or string
	 * @throws \RangeException if $newPostingEndDate is a date that does not exist
	 **/
	public function setPostingEndDate($newPostingEndDate = null) : void {
		// base case: if the date is null, use the current date and time
		if($newPostingEndDate === null) {
			$this->postingEndDate = new \DateTime();
			return;
		}

		// store the like date using the ValidateDate trait
		try {
			$newPostingEndDate = self::validateDateTime($newPostingEndDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->postingEndDate = $newPostingEndDate;
	}
	/**
	 * accessor method for posting role
	 * @return string value of posting role
	 **/
	public function getPostingRole(): string {
		return ($this->postingRole);
	}

	/**
	 * mutator method for posting role
	 * @param string $newPostingRole new value of posting role
	 * @throws \typeError if $newPostingRole is not a string

	 **/
	public function setPostingRole($newPostingRole): void {
		$newPostingRole = trim($newPostingRole);
		$newPostingRole = filter_var($newPostingRole, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPostingRole) === true) {
			throw(new \InvalidArgumentException("your role is missing"));
		}}
	/**
/**
 * formats the state variables for JSON serialization
 *
 * @return array resulting state variables to serialize
 **/
public function jsonSerialize() : array {
	$fields = get_object_vars($this);

	$fields["postingId"] = $this->postingId->toString();
}}