<?php
namespace PhpGitTests;

use PhpGit\Git;
use PhpGit\ShellCommand\Executor;
use PhpGit\ShellCommand\Response;

require_once __DIR__.'/../PhpGit/Git.php';

/**
 * Class GitRepositoryTest
 * @author  Raphaël Pommier (raphael@pommier.me)
 * @since   2014-02-22
 */
class GitTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @return \PHPUnit_Framework_MockObject_MockObject|Executor
	 */
	private function getMockedExecutor() {
		return $this->getMockBuilder('\PhpGit\ShellCommand\Executor')->getMock();
	}

	public function testSetExecutor() {
		$git = new Git();
		$git->setExecutor($this->getMockedExecutor());
		$this->assertEquals(
			$this->getMockedExecutor(),
			$git->getExecutor()
		);
	}

	public function testSetLastResponse() {
		$response = new Response(0, array(''), 0.002);
		$git = new Git();
		$git->setLastResponse($response);
		$this->assertEquals(
			$response,
			$git->getLastResponse()
		);
	}

	public function testGo() {
		$mockedExecutor = $this->getMockedExecutor();
		$mockedExecutor
			->expects($this->any())
			->method('execute')
			->will($this->returnValueMap(array(
					array("echo 42", new Response(0, array('42'), 0.123)),
					array("echo42", new Response(127, array("-bash: echo42: command not found"), 0.123)),
				)
			));

		$git = new Git();
		$git->setExecutor($mockedExecutor);

		$this->assertTrue(
			$git->go('echo 42')
		);

		$this->assertFalse(
			$git->go('echo42')
		);
	}

	public function testAdd() {
		$mockedExecutor = $this->getMockedExecutor();
		$mockedExecutor
			->expects($this->any())
			->method('execute')
			->will($this->returnValueMap(array(
					array("git add -v 'azerty.txt' 'qsdfgh.php' 'wxcvbn.sql'", new Response(0, array(''), 0.123)),
					array("git add -v 'azerty.txt2' 'qsdfgh.php' 'wxcvbn.sql'", new Response(128, array("fatal: le chemin 'azerty.txt2' ne correspond à aucun fichier"), 0.123)),
				)
			));

		$git = new Git();
		$git->setExecutor($mockedExecutor);

		$this->assertTrue(
			$git->add(array(
				'azerty.txt',
				'qsdfgh.php',
				'wxcvbn.sql'
			))
		);

		$this->assertFalse(
			$git->add(array(
				'azerty.txt2',
				'qsdfgh.php',
				'wxcvbn.sql'
			))
		);
	}
}
