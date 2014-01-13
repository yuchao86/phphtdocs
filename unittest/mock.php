<?php

include_once "PHPUnit/Autoload.php";
require_once "SomeClass.php";

class StubTest extends PHPUnit_Framework_TestCase
{
	public function testStub()
	{
		$stub = $this->getMock('SomeClass');

		$stub->expects($this->any())
			->method('doSomething')
			->will($this->returnValue('Class Unit test'));

		$this->assertEquals('Class Unit test',$stub->doSomething());
	}
}

$stub = new StubTest();

echo "====Test Result is:".$stub->testStub();
