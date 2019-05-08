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
	 *
	 * @return Uuid value of posting id
	 **/
	public function getPostingId(): Uuid {
		return ($this->postingId);
	}

	/**
	 * mutator method for Posting Id
	 *
	 * @param Uuid|string $newPostingId new value of Posting Id
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
	 *
	 * @return string value of posting content
	 **/
	public function getPostingContent(): string {
		return ($this->postingContent);
	}

	/**
	 * mutator method for Posting content
	 *
	 * @param string $newPostingContent new value of Posting content
	 * @throws \RangeException if $newPostingId is not positive
	 * @throws \TypeError if $newPostingId is not a uuid or string
	 **/
	public function setPostingContent($newPostingContent): void {
		$newPostingContent = trim($newPostingContent);
		$newPostingContent = filter_var($newPostingContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPostingContent) === true) {
			throw(new \InvalidArgumentException("posting content is empty or insecure"));
		}
	}

/**
 * formats the state variables for JSON serialization
 *
 * @return array resulting state variables to serialize
 **/
public function jsonSerialize() : array {
	$fields = get_object_vars($this);

	$fields["postingId"] = $this->postingId->toString();
}}