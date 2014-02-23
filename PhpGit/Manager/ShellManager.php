<?php

namespace PhpGit\Manager;
use PhpGit\Entity\ExecutionResponse;

/**
 * _
 * @author  Rapha�l Pommier (raphael@pommier.me)
 * @since   2014-02-23
 */
class ShellManager {

	public function __construct() {
	}

	public function execute($command) {
		$microtime = microtime(true);
		exec($command, $output, $returnCode);
		return new ExecutionResponse($returnCode, $output, microtime(true) - $microtime);
	}
}
