<?php

namespace tgray19\webdevjobs;

require_once(dirname(__DIR__) . "/vendor/autoload.php");
require_once("autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Building the Profile class and what is stored.
 *
 * @author Trystan Gray <trystangray7@gmail.com>
 *@version 1.0.0
 */
class Profile {
	use ValidateUuid;
	use ValidateDate;
	/**
	 * Naming all my attributes as private.
	 */
	private $profileId;
	private $profileRoleId;
	private $profileActivationToken;
	private $profileHash;
	private $profileUsername;
	private $profileImage;
	private $profileBio;
	private $profileLocation;
	private $profileEmail;

	/**
	 * constructor for this Profile
	 *
	 * @param string|Uuid $newProfileId id of this profile or null if new.
	 * @param string|Uuid $newProfileRoleId id of this profile or null if new.
	 * @param string $newProfileActivationToken string containing activation token.
	 * @param string $newProfileHash string for profile password.
	 * @param string $newProfileUsername string containing profile username.
	 * @param string $newProfileImage url for profile picture.
	 * @param string $newProfileBio string blob for profile bio.
	 * @param string $newProfileLocation string for profile location.
	 * @param string $newProfileEmail profiles email address.
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newProfileId, $newProfileRoleId, string $newProfileActivationToken, string $newProfileHash,
										 string $newProfileUsername, string $newProfileImage, string $newProfileBio, string $newProfileLocation, string $newProfileEmail) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileRoleId($newProfileRoleId);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileHash($newProfileHash);
			$this->setProfileUsername($newProfileUsername);
			$this->setProfileImage($newProfileImage);
			$this->setProfileBio($newProfileBio);
			$this->setProfileLocation($newProfileLocation);
			$this->setProfileEmail($newProfileEmail);
		}//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 *Accessor method for profileId
	 * @return string|Uuid for profileId (or null if new Profile)
	 */
	public function getProfileId(): Uuid {
		return ($this->profileId);
	}
	/**
	 * mutator method for profile id
	 *
	 * @param  string $newProfileId value of new profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if the profileId is not positive
	 **/
	public function setProfileId($newProfileId): void {
		try {
			$uuid = self::ValidateUuid($newProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->profileId = $uuid;
	}

	/**
	 *Accessor method for profileRoleId
	 * @return string|Uuid for profileRoleId (or null if new Profile)
	 */
	public function getProfileRoleId(): Uuid {
		return ($this->profileRoleId);
	}
	/**
	 * mutator method for profileRole id
	 *
	 * @param  string $newProfileRoleId value of new profileRole id
	 * @throws \RangeException if $newProfileRoleId is not positive
	 * @throws \TypeError if the profileRoleId is not positive
	 **/
	public function setProfileRoleId($newProfileRoleId): void {
		try {
			$uuid = self::ValidateUuid($newProfileRoleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profileRole id
		$this->profileRoleId = $uuid;
	}
