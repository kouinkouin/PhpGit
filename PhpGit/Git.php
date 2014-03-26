<?php

namespace PhpGit;

use PhpGit\Repository\GitRepository;
use PhpGit\ShellCommand\Executor;
use PhpGit\ShellCommand\Response;

/**
 * Git Interface Class
 * This class enables the creating, reading, and manipulation
 * of git repositories.
 * @class  Git
 */
class Git {

	public function __construct() {

	}

	/**
	 * Response of the last execution
	 * @var Response $lastResponse
	 */
	private $lastResponse;

	/**
	 * Executor will be used to executer the next commands
	 * @var Executor $executor
	 */
	private $executor;

	/**
	 * Set the response of the last execution
	 * @param Response $lastResponse
	 */
	public function setLastResponse(Response $lastResponse) {
		$this->lastResponse = $lastResponse;
	}

	/**
	 * Returns the response of the last execution
	 * @return Response
	 */
	public function getLastResponse() {
		return $this->lastResponse;
	}

	/**
	 * Returns the GitRepository
	 * @return GitRepository
	 */
	private function getRepository() {
		return new GitRepository();
	}

	/**
	 * Set the executor will be used to executer the next commands
	 * @param Executor $executor
	 */
	public function setExecutor(Executor $executor) {
		$this->executor = $executor;
	}

	/**
	 * Returns the executor will be used to executer the next commands
	 * @return Executor
	 */
	public function getExecutor() {
		return $this->executor;
	}

	/**
	 * Execute the $command, set the response and return if execution is a success
	 * @param string $command
	 * @return bool
	 */
	public function go($command) {
		$this->setLastResponse(
			$this->getExecutor()->execute(
				$command
			)
		);
		return $this->getLastResponse()->isSuccessReturnCode();
	}

	/**
	 * Add files to stage
	 * @param array $files
	 * @return bool
	 */
	public function add(array $files) {
		return $this->go(
			$this->getRepository()->getAdd($files)
		);
	}
}
