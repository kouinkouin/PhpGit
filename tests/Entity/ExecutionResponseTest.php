<?php

namespace PhpGitTests\Entity;

use PhpGit\Entity\ExecutionResponse;

require_once __DIR__.'/../../PhpGit/Entity/ExecutionResponse.php';

/**
 * _
 * @author  Raphaël Pommier (raphael@pommier.me)
 * @since   2014-02-23
 */
class ExecutionResponseTest extends \PHPUnit_Framework_TestCase {

	public function testToArray() {
		$output = array(
			'AM tests/Entity/ExecutionResponseTest.php',
			'?? PhpGit/Entity/'
		);
		$response = new ExecutionResponse(128, $output, 0.003);
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
 