<?php

namespace careerbusters\webdevjobs;

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\DdUnit\QueryDataSet;
use PHPUnit\DdUnit\Database\Connection;
use PHPUnit\DdUnit\Operation\{Composite, Factory, Operation};

require_once (dirname(__DIR__, 3) . "/vendor/autoload.php");

/** create abstract class to test */
abstract class postingTest extends TestCase {
	use TestCaseTrait;

	/** PHPUnit database connection interface
	 *@var Connection $connection
	 */
	protected $connection = null;

	/** assemble the table from the schema and provides it to PHPUnit
	 *
	 *@return QueryDataSet assembled schema from PHPUnit
	 */
	public final function getDataSet () : QueryDataSet {
		$dataset = new QueryDataSet($this->getConnection());
		$dataset->addTable("profile");
		
	}
}