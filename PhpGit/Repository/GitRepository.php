<?php

namespace PhpGit\Repository;

/**
 * Class Repository\GitRepository
 * @author  Rapha�l Pommier (raphael@pommier.me)
 * @since   2014-02-22
 */
class GitRepository {

	private $remote = '';

	public function __construct($remote = 'origin') {
		$this->remote = (string) $remote;
	}

	/**
	 * @param string $gitCommand
	 * @return string
	 */
	private function getGitQuery($gitCommand) {
		return escapeshellcmd('git '.(string) $gitCommand);
	}

	private function getPathsString(array $paths) {
		array_walk($paths, function (&$path) {
			$path = "'$path'";
		});
		return implode(' ', $paths);
	}

	public function getCommit($message, $options = '') {
		return $this->getGitQuery('commit '.($options ? $options.' ' : '').'-m "'.$message.'"');
	}

	public function getStatus() {
		return $this->getGitQuery('status --porcelain');
	}

	public function getPush($branch = 'HEAD', $withTags = true) {
		return $this->getGitQuery('push --porcelain '.($withTags ? '--tags ' : '').$this->remote.' '.$branch);
	}

	public function getFetch() {
		return $this->getGitQuery('fetch -v '.$this->remote);
	}

	public function getAdd(array $files) {
		return $this->getGitQuery('add -v '.$this->getPathsString($files));
	}

	public function getRm(array $files, $isRecursive = true, $fromStaged = false) {
		return $this->getGitQuery('rm -q '.($isRecursive ? '-r ' : '').($fromStaged ? '--cached ' : '').$this->getPathsString($files));
	}

	public function getCheckout($branch, $create = false) {
		return $this->getGitQuery('checkout -q '.($create ? '--no-track -b ' : '').$branch);
	}


}
 