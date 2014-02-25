<?php

namespace PhpGit\ShellCommand;

/**
 * _
 * @author  Rapha�l Pommier (raphael@pommier.me)
 * @since   2014-02-23
 */
class Executor {

	public function __construct() {
	}

	public function execute($command) {
		$microtime = microtime(true);
		exec($command, $output, $returnCode);
		return new Response($returnCode, $output, microtime(true) - $microtime);
	}
}
