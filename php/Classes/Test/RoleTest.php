<?php

<<<<<<< HEAD
namespace CareerBuster\WebDevJobs\Test;

use CareerBuster\WebDevJobs\Role;
=======
namespace CareerBusters\WebDevJobs\Test;

use CareerBusters\WebDevJobs\Role;
>>>>>>> develop

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");


/**
 * Full PHPUnit test for the Role Class
 *
 * This is a complete PHPUnit test of the Role class. It is complete because *ALL*
 * mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see RoleTest
 * @author Natasha Lovato <nmarshlovato@cnm.edu>
 **/
class RoleTest extends WebDevJobsTest {
	/**
	 * Role id that created the Role; this is for foreign key relations
	 * @var Role role
	 **/
	protected $roleId = null;

	/**
	 * content of the Role Name
	 * @var string $VALID_ROLENAME
	 **/
	protected $VALID_ROLENAME = "PHPUnit test passing";

<<<<<<< HEAD
	/**
	 * content of the Role Name
	 * var string $VALID_ROLENAME2 = "PHPUnit test still passing";
	 **/
	protected $VALID_ROLENAME2 = "PHPUnit test passing";

=======
>>>>>>> develop

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp(): void {
		// run the default setUp() method first
		parent::setUp();
	}

	/**
	 * test inserting a valid Role and verify that the actual mySQL data matches
	 **/
<<<<<<< HEAD
	public function testInsertValidRole(): void {
=======
	public function testInsertValidRoleTest(): void {
>>>>>>> develop
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("role");

		// create a new Role and insert to into mySQL
		$roleId = generateUuidV4();
		$role = new Role($roleId, $this->VALID_ROLENAME);
		$role->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoRole = Role::getRoleByRoleId($this->getPDO(), $role->getRoleId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("role"));
<<<<<<< HEAD
		$this->assertEquals($pdoRole->getRoleId(), $roleId);
		$this->assertEquals($pdoRole->getRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoRole->getRoleName(), $this->VALID_ROLENAME);
	}

	/**
	 * test inserting a Role, editing it, and then updating it
	 **/
	public function testUpdateValidRole(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("role");

		// create a new Role and insert to into mySQL
		$roleId = generateUuidV4();
		$role = new Role($roleId, $this->VALID_ROLENAME);
		$role->insert($this->getPDO());

		// edit the Role and update it in mySQL
		$role->setRoleName($this->VALID_ROLENAME2);
		$role->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoRole = Role::getRoleByRoleId($this->getPDO(), $role->getRoleId());
		$this->assertEquals($pdoRole->getRoleId(), $roleId);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("role"));
		$this->assertEquals($pdoRole->getRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoRole->getRoleName(), $this->VALID_ROLENAME2);
	}
=======
		$this->assertEquals($pdoRole->getRoleId(), $roleId->toString());
		$this->assertEquals($pdoRole->getRoleName(), $this->VALID_ROLENAME);
	}


	/**
	 * test inserting a Role, editing it, and then updating it
	 *
	 * public function testUpdateValidRole(): void {
	 * // count the number of rows and save it for later
	 * $numRows = $this->getConnection()->getRowCount("role");
	 *
	 * // create a new Role Test and insert to into mySQL
	 * $roleId = generateUuidV4();
	 * $role = new Role($roleId, $this->VALID_ROLENAME);
	 * $role->insert($this->getPDO());
	 *
	 * // edit the Role and update it in mySQL
	 * $role->setRoleName($this->VALID_ROLENAME2);
	 * $role->update($this->getPDO());
	 *
	 * // grab the data from mySQL and enforce the fields match our expectations
	 * $pdoRole = Role::getRoleByRoleId($this->getPDO(), $role->getRoleId());
	 * $this->assertEquals($pdoRole->getRoleId(), $roleId);
	 * $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("role"));
	 * $this->assertEquals($pdoRole->getRoleName(), $this->VALID_ROLENAME);
	 * }
	 **/
>>>>>>> develop

	/**
	 * test creating a Role and the deleting it
	 **/
	public function testDeleteValidRole(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("role");
<<<<<<< HEAD

		// create a new Role and insert to into mySQL
		$roleId = generateUuidV4();
		$role = new Role($roleId, $this->roleId->getRoleId(), $this->VALID_ROLENAME, $this->VALID_ROLENAME2);
=======
		// create a new Role and insert to into mySQL
		$roleId = generateUuidV4();
		$role = new Role($roleId, $this->VALID_ROLENAME);
>>>>>>> develop
		$role->insert($this->getPDO());
		// delete the Role from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("role"));
		$role->delete($this->getPDO());
<<<<<<< HEAD

		// grab the data from mySQL and enforce the Role does not exist
		$pdoRole = Role::getRolebyRoleId($this->getPDO(), $role->getRoleId()
	);
$this->assertNull($pdoRole);
$this->assertEquals($numRows, $this->getConnection()->getRowCount("role")
);
}
=======
		// grab the data from mySQL and enforce the Role does not exist
		$pdoRole = Role::getRoleByRoleId($this->getPDO(), $role->getRoleId());
		$this->assertNull($pdoRole);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("role"));
	}
>>>>>>> develop

	/**
	 * test grabbing all Roles
	 **/
	public function testGetAllValidRoles(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("role");

		// create a new Role and insert to into mySQL
		$roleId = generateUuidV4();
<<<<<<< HEAD
		$role = new Role($roleId, $this->role->getRoleId(), $this->VALID_ROLENAME);
=======
		$role = new Role($roleId, $this->VALID_ROLENAME);
>>>>>>> develop
		$role->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Role::getAllRoles($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("role"));
		$this->assertCount(1, $results);
<<<<<<< HEAD
		$this->assertContainsOnlyInstancesOf("CareerBusters\\WebDevJob\\Role", $results);
=======
		$this->assertContainsOnlyInstancesOf("CareerBusters\\WebDevJobs\\Role", $results);
>>>>>>> develop

		// grab the result from the array and validate it
		$pdoRole = $results[0];
		$this->assertEquals($pdoRole->getRoleId(), $roleId);
<<<<<<< HEAD
		$this->assertEquals($pdoRole->getRoleId(), $this->role->getRoleId());
=======
>>>>>>> develop
		$this->assertEquals($pdoRole->getRoleName(), $this->VALID_ROLENAME);
	}
}