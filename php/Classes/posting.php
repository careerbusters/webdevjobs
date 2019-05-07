<?php

/** create class for table posting */

class Posting implements \JsonSerializable {
	use validatedDate;
	use validatedUuid;

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
	 * @var DateTime $postingDate
	 **/
	private $postingDate;
	/**
	 * date and time this Posting will end
	 * @var DateTime $postingEndDate
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
	 * @param string/Uuid $newPostingId from Posting
	 * @param string $newPostingContent when Posting date is newPostingDate
	 * @param string $newPostingEmail when postingId doesn't match
	 * @param string $newPostingLocation Id from posting or postingContent
	 * @param string $newPostingTile Id from posting or postingContent
	 * @param string $newPostingPay Id from posting or postingContent
	 * @param string $newPostingCompanyName Id from posting or postingContent
	 * @param DateTime $newPostingDate date and time Posting was sent
	 * @param DateTime $newPostingEndDate date and time Posting was ending
	 * @param string $newPostingRole Id from posting or postingContent
	 *
	 */


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