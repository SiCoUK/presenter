<?php

use Mockery as m;
use BigElephant\Presenter\Presenter;

class PresenterTest extends PHPUnit_Framework_TestCase {

	public function setUp()
	{
		$this->injectObject = new InjectStub;
	}

	public function tearDown()
	{
		m::close();
	}

	public function testPresenterVariableCalls()
	{
		$presenter = new PresenterStub($this->injectObject);

		$this->assertEquals($presenter->testVar, 'testvar');
		$this->assertEquals($presenter->testVar2, 'testvar2');
	}

	public function testPresenterMethodCalls()
	{
		$presenter = new PresenterStub($this->injectObject);

		$this->assertEquals($presenter->testMethod(), 'testMethod');
		$this->assertEquals($presenter->testMethod2(), 'testMethod2');
	}

	public function testNestedPresenterVariableCalls()
	{
		$presenter = new PresenterStub(new PresenterStub2($this->injectObject));

		$this->assertEquals($presenter->testVar, 'testvar');
		$this->assertEquals($presenter->testVar2, 'testvar2');
		$this->assertEquals($presenter->testVar3, 'testvar3');
	}

	public function testNestedPresenterMethodCalls()
	{
		$presenter = new PresenterStub(new PresenterStub2($this->injectObject));

		$this->assertEquals($presenter->testMethod(), 'testMethod');
		$this->assertEquals($presenter->testMethod2(), 'testMethod2');
		$this->assertEquals($presenter->testMethod3(), 'testMethod3');
	}
}

class InjectStub {

	public $testVar = 'testvar';

	public function testMethod()
	{
		return 'testMethod';
	}
}

class PresenterStub extends Presenter {

	public $testVar2 = 'testvar2';

	public function testMethod2()
	{
		return 'testMethod2';
	}
}

class PresenterStub2 extends Presenter {

	public $testVar3 = 'testvar3';

	public function testMethod3()
	{
		return 'testMethod3';
	}
}