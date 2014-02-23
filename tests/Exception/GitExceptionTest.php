<?php

namespace PhpGitTests\Exception;

require_once __DIR__.'/../../PhpGit/Exception/GitException.php';

use PhpGit\Exception\GitException;

/**
 * _
 * @author  Rapha�l Pommier (raphael@pommier.me)
 * @since   2014-02-23
 */
class GitExceptionTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException \PhpGit\Exception\GitException
	 */
	public function testConstruct() {
		throw new GitException('And shit....', 1);
	}
}
 