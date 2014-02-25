<?php

namespace PhpGitTests\Repository;

use PhpGit\Repository\GitRepository;

require_once __DIR__.'/../../PhpGit/Repository/GitRepository.php';

/**
 * Class GitRepositoryTest
 * @author  Raphaël Pommier (raphael@pommier.me)
 * @since   2014-02-22
 */
class GitRepositoryTest extends \PHPUnit_Framework_TestCase {

	public function testGetCommit() {
		$gitRepository = new GitRepository();
		$assertCommand = "git commit -m \"It\\'s a new test !\"";
		$this->assertSame($assertCommand, $gitRepository->getCommit("It's a new test !"));
	}

	public function testGetCommitWithOptions() {
		$gitRepository = new GitRepository();
		$assertCommand = "git commit --amend -m \"It\\'s a new test !\"";
		$this->assertSame($assertCommand, $gitRepository->getCommit("It's a new test !", '--amend'));
	}

	public function testGetStatus() {
		$gitRepository = new GitRepository();
		$assertCommand = "git status --porcelain";
		$this->assertSame($assertCommand, $gitRepository->getStatus());
	}

	public function testGetPush() {
		$gitRepository = new GitRepository();
		$assertCommand = "git push --porcelain --tags origin HEAD";
		$this->assertSame($assertCommand, $gitRepository->getPush());
	}

	public function testGetPushWithoutTags() {
		$gitRepository = new GitRepository();
		$assertCommand = "git push --porcelain origin HEAD";
		$this->assertSame($assertCommand, $gitRepository->getPush('HEAD', false));
	}

	public function testGetFetch() {
		$gitRepository = new GitRepository();
		$assertCommand = "git fetch -v origin";
		$this->assertSame($assertCommand, $gitRepository->getFetch());
	}

	public function testGetAdd() {
		$gitRepository = new GitRepository();
		$assertCommand = "git add -v 'azerty.txt' 'qsd fgh.lst'";
		$this->assertSame($assertCommand, $gitRepository->getAdd(array('azerty.txt', 'qsd fgh.lst')));
	}

	public function testGetRmNoRecursive() {
		$gitRepository = new GitRepository();
		$assertCommand = "git rm -q 'azerty.txt'";
		$this->assertSame($assertCommand, $gitRepository->getRm(array('azerty.txt'), false));
	}

	public function testGetRmCached() {
		$gitRepository = new GitRepository();
		$assertCommand = "git rm -q -r --cached 'azerty.d' 'azerty.txt'";
		$this->assertSame($assertCommand, $gitRepository->getRm(array('azerty.d', 'azerty.txt'), true, true));
	}

	public function testGetCheckout() {
		$gitRepository = new GitRepository();
		$assertCommand = "git checkout -q mybranch";
		$this->assertSame($assertCommand, $gitRepository->getCheckout('mybranch'));
	}

	public function testGetCheckoutBranch() {
		$gitRepository = new GitRepository();
		$assertCommand = "git checkout -q --no-track -b mybranch";
		$this->assertSame($assertCommand, $gitRepository->getCheckout('mybranch', true));
	}

	public function testGetMerge() {
		$gitRepository = new GitRepository();
		$assertCommand = "git merge --no-ff mybranch";
		$this->assertSame($assertCommand, $gitRepository->getMerge('mybranch'));
	}

	public function testGetMergeWithMessage() {
		$gitRepository = new GitRepository();
		$assertCommand = "git merge --no-ff mybranch -m \"Merge happy branch into master\"";
		$this->assertSame($assertCommand, $gitRepository->getMerge('mybranch', 'Merge happy branch into master'));
	}

	public function testGetRebase() {
		$gitRepository = new GitRepository();
		$assertCommand = "git rebase master";
		$this->assertSame($assertCommand, $gitRepository->getRebase('master'));
	}

	public function testGetRebaseOnto() {
		$gitRepository = new GitRepository();
		$assertCommand = "git rebase --onto master oldmaster";
		$this->assertSame($assertCommand, $gitRepository->getRebase('master', 'oldmaster'));
	}

	public function testGetRebasePreserveMerges() {
		$gitRepository = new GitRepository();
		$assertCommand = "git rebase --preserve-merges master";
		$this->assertSame($assertCommand, $gitRepository->getRebasePreserveMerges('master'));
	}

	public function testGetRebasePreserveMergesOnto() {
		$gitRepository = new GitRepository();
		$assertCommand = "git rebase --preserve-merges --onto master oldmaster";
		$this->assertSame($assertCommand, $gitRepository->getRebasePreserveMerges('master', 'oldmaster'));
	}

	/*
	 * git clean
	 * git reset --hard
	 * git reset --mixed
	 * git reset --soft
	 * git init
	 * git clone
	 * git tag -a 0.1 -m "Stable release 0.1"
	 *
	 */
}
