<?php

namespace CareerBusters\WebDevJobs;

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\DdUnit\QueryDataSet;
use PHPUnit\DdUnit\Database\Connection;
use PHPUnit\DdUnit\Operation\{Composite, Factory, Operation};

// grab the encrypted properties file
require_once("/etc/apache2/capstone-mysql/Secret.php");

require_once (dirname(__DIR__, 3) . "/vendor/autoload.php");

/** create abstract class to test */
abstract class postingTest extends TestCase {
	use TestCaseTrait;

	/** PHPUnit database connection interface
	 * @var Connection $connection
	 */
	protected $connection = null;

	/** assemble the table from the schema and provides it to PHPUnit
	 *
	 * @return QueryDataSet assembled schema from PHPUnit
	 */
	public final function getDataSet(): QueryDataSet {
		$dataset = new QueryDataSet($this->getConnection());
		$dataset->addTable("job");
		$dataset->addTable("role");
		$dataset->addTable("profile");
		$dataset->addTable("posting");
	}


/**
 * templates for running before each test
 * @return Composite array containing delete and insert commnds
**/
public final function getSetupOperation() : Composite {
	return new Composite([
		Factory::DELETE_ALL(),
		FACTORY::INSERT()
	]);
}
/**
 *templates the tearDown for running test
 * @return Operation delete command for the database
 */
public final function getTearDownOperation() : Operation {
				return(Factory::DELETE_ALL());
}

/**
 * sets up database connection and provides it to PHPUnit
 *
 */
public final function getConnection() : Connection {
	// if the connection hasn't been established, create it
	if($this->connection === null) {
		// connect to mySQL and provide the interface to PHPUnit


		$secrets =  new Secrets("/etc/apache2/capstone-mysql/ddctwitter.ini");
		$pdo = $secrets->getPdoObject();
		$this->connection = $this->createDefaultDBConnection($pdo, $secrets->getDatabase());
	}
	return($this->connection);
}

	/**
	 * returns the actual PDO object;
	 *
	 * @return \PDO active PDO object
	 **/
	public final function getPDO() {
	return($this->getConnection()->getConnection());
}
}
