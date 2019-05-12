<?php
namespace careerbusters\webdevjobs;
require_once(dirname(__DIR__) . "/classes/autoload.php");

use http\Exception\BadUrlException;
use http\Exception\InvalidArgumentException;
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
class role {
	use ValidateDate;
	use ValidateUuid;
	/**
	 *id and Role (primary key)
	 *@var string Uuid $roleId
	 **/
protected $roleId;
/**
 * roleName and Role
 * @var $roleName
 **/
protected $roleName;

/**
 * constructor for Role
 *
 * @param string|Uuid $newRoleId if this Role or null a new Role.
 * @param string $newRoleName for role name.
 * @throws \InvalidArgumentException if data types are not valid
 * @throws \RangeException if data values type hints
 * @thorws \TypeError if data types violate type hints
 * @throws \Exception if some other excepting occurs
 * @Documentation https://php.net/manual/en/language.oop5.decon.php
 **/
public function  __construct($newRoleId, $newRoleName = null) {
	try {
		$this->setRoleId($newRoleId);
		$this->setRoleName($newRoleName);
	} //determine what exception type was thrown
	catch(\InvalidArgumentException | \RangeException | \Exception | |\TypeError$exception){
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
}

/**
 * Accessor method for roleId
 * @return string|Uuid for roleId (or null if new Role)
 **/
Public function getRoleId(): Uuid {
	return ($this->roleId);
}

/**
 * mutator method for role id
 *
 * @param string $newRoleId
 * @throws \RangeException if $newRoleId is not positive
 * @throws \TypeError if the role Id is not positive
 **/
public function setRoleId($newRoleId): void {
	try{
		$uuid =self::validateUuid($newRoleId);
	} catch(\InvalidArgumentException | \RangeException | \Exception |\TypeError $exception) {
		$exception = get_class($exception);
		throw(new $exceptionType($exception->getMessage(),0, $exception));
	}
	//convert and store the role id
	$this->roleId = $uuid;
}

/**
 * Accessor method for roleName
 * @return string|Uuid for roleName (or null if new Role Name)
 **/
public function getRoleName(): Uuid {
	return ($this->roleName);
}

/**
 * mutator method for role name
 *
 * @param string $newRoleName value of a new role name
 * @throws \RangeException if $newRoleName is not positive
 * @throws \TypeError if the role name is not positive
 **/
public function setRoleName($newRoleName): Void {
	try{
		$uuid = self::validateUuid($newRoleName);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	//convert and store role name
	$this->roleName = $uuid;
}

/**
 * Accessor method for roleName
 * @return srting for roleName
 **/
public function getRoleName(): string {
	return ($this->roleName);
}

/**
 * inserts into roles mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function insert(\PDO $pdo): void {
	//create query template
	$query = "INSERT INTO role(roleId, roleName) VALUES(:roleId, :roleName)";
	$statement = $pdo->prepare($query);

	//bind the member variables to the place holders in the template
	$parameters = ["roleId" => $this->roleId->getBytes(), "roleName" => $this->roleName];
	$statement->execute($parameters);
}

/**
 * deletes this role for mySQL
 *
 * @param \PDO $pdo PDOconnection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function delete(\PDO $pdo): void {

	//create query template
	$query = "DELETE FROM role WHERE roleId = :roleId";
	$statement = $pdo->prepare($query);

	//bind the member variables to the place in the template
	$parameters = ["roleId" => $this->roleId->getBytes()];
	$statement->execute($parameters);
	}

	/**
	 * updates this role in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @thorws \PDOException when mySQL related errors occur
	 * @thorws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo): void {

		//create query template
		$query = "UPDATE role SET roleId = :roleId, roleName = :roleName"

}

}