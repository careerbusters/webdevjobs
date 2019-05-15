<?php
namespace CareerBuster\WebDevJob;

use CareerBuster\WebDevJob\DataDesign\{RoleId, Role};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

/**
 * create dependent objects before running each test
 **/
public final function setUp()  : void {
	// run the default setUp() method first
	parent::setUp();


	/**
	 * test inserting a valid Role and verify that the actual mySQL data matches
	 **/
	public
	function testInsertValidRole(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("role");

		// create a new Role and insert to into mySQL
		$roleId = generateUuidV4();
		$role = new role($roleId, $this->role->getRoleId(), $this->VALID_ROLEID, $this->VALID_ROLENAME);
		$role->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoROLE = Tweet::getRoleByRoleId($this->getPDO(), $role->getRoleId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("role"));
		$this->assertEquals($pdoRole->getRoleId(), $roleId);
		$this->assertEquals($pdoRole->getRoleId(), $this->role->getRoleId());
		$this->assertEquals($pdoRole->getRoleName(), $this->VALID_ROLENAME);
	}
}