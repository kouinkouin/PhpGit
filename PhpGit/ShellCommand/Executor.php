<?php

namespace PhpGit\ShellCommand;

/**
 * _
 * @author  Raphaël Pommier (raphael@pommier.me)
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
