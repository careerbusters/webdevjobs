<?php

namespace CareerBuster\WebDevJobs\Test;

use CareerBuster\WebDevJobs\Role;

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
	 * contect of the Role Name
	 * @var string $VALID_ROLENAME
	 **/
	protected $VALID_ROLENAME = "PHPUnit test passing";

	/**
	 * content of the Role Name
	 * var string $VALID_ROLENAME2 = "PHPUnit test still passing";
	 **/
	protected $VALID_ROLENAME2 = "PHPUnit test passing";


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
	public function testInsertValidRole(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("role");

		// create a new Role and insert to into mySQL
		$roleId = generateUuidV4();
		$role = new role($roleId, $this->role->getRoleId(), $this->VALID_ROLEID, $this->VALID_ROLENAME);
		$role->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoROLE = Role\::getRoleByRoleId($this->getPDO(), $role->getRoleId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("role"));
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
		$role = new Role($roleId, $this->role->getRoleId(), $this->VALID_ROLEID, $this->VALID_ROLENAME);
		$role->insert($this->getPDO());

		// edit the ROLE and update it in mySQL
		$role->setRoleId($this->VALID_ROLEID2);
		$role->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoRole = Role::getRoleByRoleId($this->getPDO(), $role->getRoleId());
		$this->assertEquals($pdoRole->getRoleId(), $roleId);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("role"));
		$this->assertEquals($pdoRole->getRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoRole->getRoleName(), $this->VALID_ROLENAME2);
	}

	/**
	 * test grabbing all Roles
	 **/
	public function testGetAllValidRoles(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("role");

		// create a new Role and insert to into mySQL
		$roleId = generateUuidV4();
		$role = new Role($roleId, $this->role->getRoleId(), $this->VALID_ROLENAME);
		$role->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Role::getAllRoles($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("role"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("CareerBusters\\WebDevJob\\Role", $results);

		// grab the result from the array and validate it
		$pdoRole = $results[0];
		$this->assertEquals($pdoRole->getRoleId(), $roleId);
		$this->assertEquals($pdoRole->getRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoRole->getRoleName(), $this->VALID_ROLENAME);
	}