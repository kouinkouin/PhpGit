<?php

namespace PhpGitTests\Manager;

require_once __DIR__.'/../../PhpGit/Manager/ShellManager.php';

use PhpGit\Manager\ShellManager;

/**
 * _
 * @author  Raphaël Pommier (raphael@pommier.me)
 * @since   2014-02-23
 */
class GitManagerTest extends \PHPUnit_Framework_TestCase {

	public function testExecute() {
		$gitManager = new ShellManager();
		$response = $gitManager->execute('echo 42');
		$this->assertInstanceOf('PhpGit\Entity\ExecutionResponse', $response);
		$this->assertSame(0, $response->getReturnCode());
		$this->assertSame(array('42'), $response->getOutput());
	}
}
