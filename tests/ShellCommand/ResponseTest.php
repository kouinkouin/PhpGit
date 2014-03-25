<?php

namespace PhpGitTests\ShellCommand;

use PhpGit\ShellCommand\Response;

require_once __DIR__.'/../../PhpGit/ShellCommand/Response.php';

/**
 * _
 * @author  Raphaël Pommier (raphael@pommier.me)
 * @since   2014-02-23
 */
class ResponseTest extends \PHPUnit_Framework_TestCase {

	public function testGetOutPut() {
		$output = array(
			'AM tests/ShellCommand/ResponseTest.php',
			'?? PhpGit/ShellCommand/'
		);
		$response = new Response(128, $output, 0.003);
		$this->assertSame(
			'AM tests/ShellCommand/ResponseTest.php
?? PhpGit/ShellCommand/',
			$response->getOutput()
		);
	}

	public function testGetOutPutLines() {
		$output = array(
			'AM tests/ShellCommand/ResponseTest.php',
			'?? PhpGit/ShellCommand/'
		);
		$response = new Response(128, $output, 0.003);
		$this->assertSame(
			$output,
			$response->getOutputLines()
		);
	}

	public function testToArray() {
		$output = array(
			'AM tests/ShellCommand/ResponseTest.php',
			'?? PhpGit/ShellCommand/'
		);
		$response = new Response(128, $output, 0.003);
		$this->assertSame(
			array(
				'returnCode'    => 128,
				'output'        => 'AM tests/ShellCommand/ResponseTest.php
?? PhpGit/ShellCommand/',
				'executionTime' => 0.003
			),
			$response->toArray()
		);
	}

	public function testIsSuccessReturnCode() {
		$response = new Response(128, array('44'), 0.003);
		$this->assertEquals(
			false,
			$response->isSuccessReturnCode()
		);

		$response = new Response(1, array('43'), 0.003);
		$this->assertEquals(
			false,
			$response->isSuccessReturnCode()
		);

		$response = new Response(0, array('42'), 0.003);
		$this->assertEquals(
			true,
			$response->isSuccessReturnCode()
		);
	}

}
 