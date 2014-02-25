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

	public function testToArray() {
		$output = array(
			'AM tests/ShellCommand/ResponseTest.php',
			'?? PhpGit/ShellCommand/'
		);
		$response = new Response(128, $output, 0.003);
		$this->assertSame(
			array(
				'returnCode'    => 128,
				'output'        => $output,
				'executionTime' => 0.003
			),
			$response->toArray()
		);
	}

}
 