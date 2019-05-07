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
	 * actual city location of the Posting
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
	 * @param string $newPostingContent when Posting date is newPostingDate
	 * @param string $newPostingEmail when postingId doesn't match
	 * @param string $newPostingLocation Id from posting or postingContent
	 * @param string $newPostingTitle Id from posting or postingContent
	 * @param string $newPostingPay Id from posting or postingContent
	 * @param string $newPostingCompanyName Id from posting or postingContent
	 * @param /DateTime $newPostingDate date and time Posting was sent
	 * @param /DateTime $newPostingEndDate date and time Posting was ending
	 * @param string $newPostingRole Id from posting or postingContent
	 * @throws /RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws /TypeError if data types violate type hints
	 * @throws 	/Exception if some other exception occurs
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
		}
//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["postingId"] = $this->postingId->toString();

		//format the date so that the front end can consume it
		$fields["postingDate"] = round(floatval($this->postingDate->format("U.u")) * 1000);
		return ($fields);
	}
}