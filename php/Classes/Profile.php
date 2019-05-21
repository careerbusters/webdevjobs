<?php

namespace CareerBusters\WebDevJobs;

require_once(dirname(__DIR__) . "/vendor/autoload.php");
require_once("autoload.php");

use Ramsey\Uuid\Uuid;
use CareerBusters\WebDevJobs\Role;

/**
 * Building the Profile class and what is stored.
 *
 * @author Trystan Gray <trystangray7@gmail.com>
 *@version 1.0.0
 */

class Profile implements \JsonSerializable {
	use ValidateUuid;
	use ValidateDate;

	/**
	 * id and P.K. for Profile
	 * @var string Uuid $profileId
	 */
	private $profileId;

	/**
	 * another id but for role for Profile
	 * @var string Uuid $profileRoleId
	 */
	private $profileRoleId;

	/**
	 *This is the activation token verifying Profile isn't malicious
	 * @var $profileActivationToken
	 */
	private $profileActivationToken;

	/**
	 * This is the bio about the profile;
	 * @var $profileBio
	 */
	private $profileBio;

	/**
	 * This is the profiles email;
	 * @var $profileEmail
	 */
	private $profileEmail;

	/**
	 * This is part of password protection;
	 * @var $profileHash
	 */
	private $profileHash;

	/**
	 * This is the profile picture;
	 * @var $profileImage
	 */
	private $profileImage;

	/**
	 * This is the profiles location;
	 * @var $profileLocation
	 */
	private $profileLocation;

	/**
	 * This is the profiles username;
	 * @var $profileUsername
	 */
	private $profileUsername;

	/**
	 * constructor for this Profile
	 *
	 * @param string|Uuid $newProfileId id of this profile or null if new.
	 * @param string|Uuid $newProfileRoleId id of this profile or null if new.
	 * @param string $newProfileActivationToken string containing activation token.
	 * @param string $newProfileBio for profile bio.
	 * @param string $newProfileEmail profiles email address.
	 * @param string $newProfileHash string for profile password.
	 * @param string $newProfileImage url for profile picture.
	 * @param string $newProfileLocation string for profile location.
	 * @param string $newProfileUsername string containing profile username.
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/

	public function __construct($newProfileId, $newProfileRoleId, string $newProfileActivationToken,  ?string $newProfileBio,
										 string $newProfileEmail, string $newProfileHash, ?string $newProfileImage, ?string $newProfileLocation, string $newProfileUsername) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileRoleId($newProfileRoleId);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileBio($newProfileBio);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileHash($newProfileHash);
			$this->setProfileImage($newProfileImage);
			$this->setProfileLocation($newProfileLocation);
			$this->setProfileUsername($newProfileUsername);
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

	/**
	 *Accessor method for profileActivationToken
	 * @return string for profileActivationToken
	 */

	public function getProfileActivationToken(): ?string {
		return ($this->profileActivationToken);
	}

	/**
	 * mutator method for profile activation token
	 *
	 * @param  string $newProfileActivationToken value of new profile activation token
	 * @throws \InvalidArgumentException if $newProfileActivationToken is not a valid url or insecure
	 * @throws \RangeException if $newProfileActivationToken is over charset
	 * @throws \TypeError if the profile activation is not a string
	 **/

	public function setProfileActivationToken(string $newProfileActivationToken): void {
		if($newProfileActivationToken === null) {
			$this->profileActivationToken = null;
			return;
		}
		$newProfileActivationToken = strtolower(trim($newProfileActivationToken));
		if(ctype_xdigit($newProfileActivationToken) === false) {
			throw(new\TypeError("profile activation is not valid"));
		}
		//make sure profile activation token is 32 characters
		if(strlen($newProfileActivationToken) !== 32) {
			throw(new\RangeException("profile activation token has to be 32 characters"));
		}
		// convert and store the activation token
		$this->profileActivationToken = $newProfileActivationToken;
	}

	/**
	 *Accessor method for profileBio
	 * @return string for profileBio
	 */

	public function getProfileBio(): ?string {
		return ($this->profileBio);
	}

	/**
	 * mutator method for profileBio
	 *
	 * @param  string $newProfileBio value of new profile bio
	 * @throws \InvalidArgumentException if $newProfileBio is not valid or insecure
	 * @throws \RangeException if $newProfileBio is over charset
	 * @throws \TypeError if the $newProfileBio is not a string
	 **/

	public function setProfileBio(?string $newProfileBio): void {
		// verify the at handle is secure
		if($newProfileBio === null) {
			$this->profileBio = $newProfileBio;
			return;
		}
		$newProfileBio = trim($newProfileBio);
		$newProfileBio = filter_var($newProfileBio, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileBio) === true) {
			throw(new \InvalidArgumentException("Profile bio is empty or insecure"));
		}
		// verify the bio will fit in the database
		if(strlen($newProfileBio) > 30000) {
			throw(new \RangeException("Bio is too large"));
		}
		// store the bio
		$this->profileBio = $newProfileBio;
	}

	/**
	 *Accessor method for profileEmail
	 * @return string for profileEmail
	 */

	public function getProfileEmail(): ?string {
		return ($this->profileEmail);
	}

	/**
	 * mutator method for profile email
	 *
	 * @param  string $newProfileEmail value of new profile email
	 * @throws \InvalidArgumentException if $newProfileEmail is not a valid email or insecure
	 * @throws \RangeException if $newProfileEmail is over charset
	 * @throws \TypeError if the profile email is not a string
	 **/

	public function setProfileEmail(string $newProfileEmail): void {
// verify the email content is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_EMAIL);
		if(empty($newProfileEmail) === true) {
			throw(new \InvalidArgumentException("Email is empty or insecure"));
		}
		// verify the email content will fit in the database
		if(strlen($newProfileEmail) > 64) {
			throw(new \RangeException("email content too large"));
		}
		// store the email content
		$this->profileEmail = $newProfileEmail;
	}

	/**
	 *Accessor method for profileHash
	 * @return string for profileHash
	 */

	public function getProfileHash(): ?string {
		return ($this->profileHash);
	}

	/**
	 * mutator method for profile hash
	 *
	 * @param  string $newProfileHash value of profile hash
	 * @throws \InvalidArgumentException if $newProfileHash is not a valid hash key or insecure
	 * @throws \RangeException if $newProfileHash is over charset
	 * @throws \TypeError if the $newProfileHash is not a string
	 **/

	public function setProfileHash(string $newProfileHash): void {
//enforce that the hash is properly formatted
		$newProfileHash = trim($newProfileHash);
		if(empty($newProfileHash) === true) {
			throw(new \InvalidArgumentException("Profile password hash empty or insecure"));
		}
		//enforce the hash is really an Argon hash
		$profileHashInfo = password_get_info($newProfileHash);
		if($profileHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("Profile hash is not a valid hash"));
		}
		//enforce that the hash is exactly 97 characters.
		if(strlen($newProfileHash) !== 97) {
			throw(new \RangeException("Profile hash must be 97 characters"));
		}
		//store the hash
		$this->profileHash = $newProfileHash;
	}

	/**
	 *Accessor method for profileImage
	 * @return string for profileImage
	 */

	public function getProfileImage(): ?string {
		return ($this->profileImage);
	}

	/**
	 * mutator method for profileImage
	 *
	 * @param  string $newProfileImage value of new profile url
	 * @throws \InvalidArgumentException if $newProfileImage is not a valid url or insecure
	 * @throws \RangeException if $newProfileImage is over charset
	 * @throws \TypeError if the $newProfileImage is not a string
	 **/

	public function setProfileImage(?string $newProfileImage): void {
// verify the image content is secure
		if($newProfileImage === null) {
			$this->profileImage = $newProfileImage;
			return;
		}
		$newProfileImage = trim($newProfileImage);
		$newProfileImage = filter_var($newProfileImage, FILTER_SANITIZE_URL, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileImage) === true) {
			throw(new \InvalidArgumentException("Image url is empty or insecure"));
		}
		// verify the image content will fit in the database
		if(strlen($newProfileImage) > 255) {
			throw(new \RangeException("image content too large"));
		}
		// store the image content
		$this->profileImage = $newProfileImage;
	}

	/**
	 *Accessor method for profileLocation
	 * @return string for profileLocation
	 */

	public function getProfileLocation(): ?string {
		return ($this->profileLocation);
	}

	/**
	 * mutator method for profileLocation
	 *
	 * @param  string $newProfileLocation value of new profile location
	 * @throws \InvalidArgumentException if $newProfileLocation is not or insecure
	 * @throws \RangeException if $newProfileLocation is over charset
	 * @throws \TypeError if the $newProfileLocation is not a string
	 **/

	public function setProfileLocation(?string $newProfileLocation): void {
		// verify the location is secure
		if($newProfileLocation === null) {
			$this->profileLocation = $newProfileLocation;
			return;
		}
		$newProfileLocation = trim($newProfileLocation);
		$newProfileLocation = filter_var($newProfileLocation, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileLocation) === true) {
			throw(new \InvalidArgumentException("Profile location is empty or insecure"));
		}
		// verify the location will fit in the database
		if(strlen($newProfileLocation) > 64) {
			throw(new \RangeException("Location is too large"));
		}
		// store the location
		$this->profileLocation = $newProfileLocation;
	}

	/**
	 *Accessor method for profileUsername
	 * @return string for profileUsername
	 */

	public function getProfileUsername(): string {
		return ($this->profileUsername);
	}

	/**
	 * mutator method for profileUsername
	 *
	 * @param  string $newProfileUsername value of new profile username
	 * @throws \InvalidArgumentException if $newProfileUsername is not valid or insecure
	 * @throws \RangeException if $newProfileUsername is over charset
	 * @throws \TypeError if the $newProfileUsername is not a string
	 **/

	public function setProfileUsername(string $newProfileUsername): void {
		// verify the username is secure
		$newProfileUsername = trim($newProfileUsername);
		$newProfileUsername = filter_var($newProfileUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileUsername) === true) {
			throw(new \InvalidArgumentException("Profile username is empty or insecure"));
		}
		// verify the username will fit in the database
		if(strlen($newProfileUsername) > 64) {
			throw(new \RangeException("Username is too large"));
		}
		// store the username
		$this->profileUsername = $newProfileUsername;
	}

	/**
	 * inserts into profile class in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function insert(\PDO $pdo): void {
		// create query template
		$query = "INSERT INTO profile(profileId, profileRoleId, profileActivationToken, profileBio, profileEmail, profileHash, profileImage, profileLocation, profileUsername) 
VALUES(:profileId, :profileRoleId, :profileActivationToken, :profileBio, :profileEmail, :profileHash, :profileImage, :profileLocation, :profileUsername)";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["profileId" => $this->profileId->getBytes(), "profileRoleId" => $this->profileRoleId->getBytes(),
			"profileActivationToken" => $this->profileActivationToken, "profileBio" => $this->profileBio, "profileEmail" => $this->profileEmail,
		"profileHash" => $this->profileHash, "profileImage" => $this->profileImage, "profileLocation" => $this->profileLocation,  "profileUsername" => $this->profileUsername];
		$statement->execute($parameters);
	}

	/**
	 * updates this Profile class in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {
		// create query template
		$query = "UPDATE profile SET profileRoleId = :profileRoleId, profileActivationToken = :profileActivationToken, profileBio = :profileBio, profileEmail = :profileEmail,
 profileHash = :profileHash, profileImage = :profileImage, profileLocation = :profileLocation, profileUsername = :profileUsername WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);
		$parameters = ["profileId" => $this->profileId->getBytes(), "profileRoleId" => $this->profileRoleId,
			"profileActivationToken" => $this->profileActivationToken, "profileBio" => $this->profileBio, "profileEmail" => $this->profileEmail,
			"profileHash" => $this->profileHash, "profileImage" => $this->profileImage, "profileLocation" => $this->profileLocation,  "profileUsername" => $this->profileUsername];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {
		// create query template
		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holder in the template
		$parameters = ["profileId" => $this->profileId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["profileId"] = $this->profileId->toString();
		$fields["profileRoleId"] = $this->profileRoleId->toString();
		return($fields);
	}

	/**
	 * gets the Profile by profileId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $profileId profile id to search for
	 * @return Profile|null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
public static function getProfileByProfileId(\PDO $pdo, $profileId) : ?Profile {
	// sanitize the profileId before searching
	try {
		$profileId = self::validateUuid($profileId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	// create query template
	$query = "SELECT profileId, profileRoleId, profileActivationToken, profileBio, profileEmail, profileHash, profileImage, profileLocation, profileUsername FROM profile WHERE profileId = :profileId";
	$statement = $pdo->prepare($query);
	// bind the profile id to the place holder in the template
	$parameters = ["profileId" => $profileId->getBytes()];
	$statement->execute($parameters);
	// grab the profile from mySQL
	try {
		$profile = null;
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		if($row !== false) {
			$profile = new profile($row["profileId"], $row["profileRoleId"], $row["profileActivationToken"], $row["profileBio"], $row["profileEmail"], $row["profileHash"], $row["profileImage"], $row["profileLocation"], $row["profileUsername"]);
		}
	} catch(\Exception $exception) {
		// if the row couldn't be converted, rethrow it
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	return($profile);
}

	/**
	 * gets the Profile by profileActivationToken
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param |string $profileActivationToken profile Activation Token to search for
	 * @return Profile|null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getProfileByProfileActivationToken(\PDO $pdo, $profileActivationToken) : ?Profile {
		// sanitize the profile AT before searching
		$profileActivationToken = strtolower(trim($profileActivationToken));
		if(ctype_xdigit($profileActivationToken) === false) {
			throw(new\PDOException("profile activation is not valid"));
		}
		// create query template
		$query = "SELECT profileId, profileRoleId, profileActivationToken, profileBio, profileEmail, profileHash, profileImage,
 profileLocation, profileUsername FROM profile WHERE profileActivationToken = :profileActivationToken";
		$statement = $pdo->prepare($query);
		// bind the profile AT to the place holder in the template
		$profileActivationToken = "%$profileActivationToken%";
		$parameters = ["profileActivationToken" => $profileActivationToken->getBytes()];
		$statement->execute($parameters);
		// grab the profile from mySQL
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new profile($row["profileId"], $row["profileRoleId"], $row["profileActivationToken"], $row["profileBio"], $row["profileEmail"], $row["profileHash"], $row["profileImage"], $row["profileLocation"], $row["profileUsername"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($profile);
	}

	/**
	 * gets the Profile by profileEmail
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param |string $profileEmail profile email to search for
	 * @return Profile|null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getProfileByProfileEmail(\PDO $pdo, $profileEmail) : ?Profile {
		// sanitize the profile email before searching
		$profileEmail = trim($profileEmail);
		$profileEmail = filter_var($profileEmail, FILTER_SANITIZE_EMAIL, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($profileEmail) === true) {
			throw(new \PDOException("Email is empty or insecure"));
		}
		// create query template
		$query = "SELECT profileId, profileRoleId, profileActivationToken, profileBio, profileEmail, profileHash, profileImage, 
profileLocation, profileUsername FROM profile WHERE profileEmail = :profileEmail";
		$statement = $pdo->prepare($query);
		// bind the profile email to the place holder in the template
		$profileEmail = "%$profileEmail%";
		$parameters = ["profileEmail" => $profileEmail->getBytes()];
		$statement->execute($parameters);
		// grab the profile from mySQL
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new profile($row["profileId"], $row["profileRoleId"], $row["profileActivationToken"], $row["profileBio"], $row["profileEmail"], $row["profileHash"], $row["profileImage"], $row["profileLocation"], $row["profileUsername"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($profile);
	}

	/**
	 * gets the Profile by profileUsername
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param |string $profileUsername profile username to search for
	 * @return Profile|null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getProfileByProfileUsername(\PDO $pdo, $profileUsername) : ?Profile {
		// sanitize the profile username before searching
		$profileUsername = trim($profileUsername);
		$profileUsername = filter_var($profileUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($profileUsername) === true) {
			throw(new \InvalidArgumentException("Profile username is empty or insecure"));
		}
		// create query template
		$query = "SELECT profileId, profileRoleId, profileActivationToken, profileBio, profileEmail, profileHash, profileImage, 
profileLocation, profileUsername FROM profile WHERE profileUsername = :profileUsername";
		$statement = $pdo->prepare($query);
		// bind the profile username to the place holder in the template
		$profileUsername = "%$profileUsername%";
		$parameters = ["profileUsername" => $profileUsername->getBytes()];
		$statement->execute($parameters);
		// grab the profile from mySQL
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new profile($row["profileId"], $row["profileRoleId"], $row["profileActivationToken"], $row["profileBio"], $row["profileEmail"], $row["profileHash"], $row["profileImage"], $row["profileLocation"], $row["profileUsername"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($profile);
	}

	/**
	 * gets the Profiles by profileRoleId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $profileRoleId profileRoleId to search by
	 * @return \SplFixedArray SplFixedArray of profile found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByProfileRoleId(\PDO $pdo, $profileRoleId) : \SplFixedArray {

		try {
			$profileRoleId = self::validateUuid($profileRoleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

// create query template
		$query = "SELECT profileId, profileRoleId, profileActivationToken, profileBio, profileEmail, profileHash, profileImage, 
profileLocation, profileUsername FROM profile WHERE profileRoleId = :profileRoleId";
		$statement = $pdo->prepare($query);
		// bind the profile role id to the place holder in the template
		$parameters = ["profileRoleId" => $profileRoleId->getBytes()];
		$statement->execute($parameters);
		// build an array
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profile = new profile($row["profileId"], $row["profileRoleId"], $row["profileActivationToken"], $row["profileBio"], $row["profileEmail"], $row["profileHash"], $row["profileImage"], $row["profileLocation"], $row["profileUsername"]);
				$profiles[$profiles->key()] = $profile;
				$profiles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}

	/**
	 * gets the Profiles by profileUsername
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $profileUsername profileUsername to search by
	 * @return \SplFixedArray SplFixedArray of profile found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfilesByProfileUsername(\PDO $pdo, $profileUsername) : \SplFixedArray {
		// sanitize the profile username before searching
		$profileUsername = trim($profileUsername);
		$profileUsername = filter_var($profileUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($profileUsername) === true) {
			throw(new \InvalidArgumentException("Profile username is empty or insecure"));
		}
// create query template
		$query = "SELECT profileId, profileRoleId, profileActivationToken, profileBio, profileEmail, profileHash, profileImage, 
profileLocation, profileUsername FROM profile WHERE profileUsername = :profileUsername";
		$statement = $pdo->prepare($query);
		// bind the profile username to the place holder in the template
		$parameters = ["profileUsername" => $profileUsername->getBytes()];
		$statement->execute($parameters);
		// build an array
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profile = new profile($row["profileId"], $row["profileRoleId"], $row["profileActivationToken"], $row["profileBio"], $row["profileEmail"], $row["profileHash"], $row["profileImage"], $row["profileLocation"], $row["profileUsername"]);
				$profiles[$profiles->key()] = $profile;
				$profiles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}}