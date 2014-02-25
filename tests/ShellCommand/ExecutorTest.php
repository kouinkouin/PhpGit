<?php

namespace PhpGitTests\ShellCommand;

use PhpGit\ShellCommand\Executor;

require_once __DIR__.'/../../PhpGit/ShellCommand/Executor.php';

/**
 * _
 * @author  Raphaël Pommier (raphael@pommier.me)
 * @since   2014-02-23
 */
class GitManagerTest extends \PHPUnit_Framework_TestCase {

	public function testExecute() {
		$gitManager = new Executor();
		$response = $gitManager->execute('echo 42');
		$this->assertInstanceOf('PhpGit\ShellCommand\Response', $response);
		$this->assertSame(0, $response->getReturnCode());
		$this->assertSame(array('42'), $response->getOutput());
	}
}
