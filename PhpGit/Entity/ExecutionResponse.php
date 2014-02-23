<?php

namespace PhpGit\Entity;

/**
 * _
 * @author  Raphaël Pommier (raphael@pommier.me)
 * @since   2014-02-23
 */
class ExecutionResponse {

	private $returnCode;
	private $output;
	private $executionTime;

	/**
	 * @param int $returnCode
	 * @param array $output
	 * @param float $executionTime
	 */
	public function __construct($returnCode, array $output, $executionTime) {
		$this->returnCode = (int) $returnCode;
		$this->output = $output;
		$this->executionTime = (float) $executionTime;
	}

	/**
	 * Returns the return code of the shell command
	 * @return int
	 */
	public function getReturnCode() {
		return $this->returnCode;
	}

	/**
	 * Returns the output (stdout & stderr) of the shell command
	 * A line by array's element
	 * @return array
	 */
	public function getOutput() {
		return $this->output;
	}

	/**
	 * Returns the execution time of the shell command
	 * @return float
	 */
	public function getExecutionTime() {
		return $this->executionTime;
	}

	/**
	 * Returns the object in array (returnCode, output, time)
	 * @return array
	 */
	public function toArray() {
		return array(
			'returnCode'    => $this->getReturnCode(),
			'output'        => $this->getOutput(),
			'executionTime' => $this->getExecutionTime()
		);
	}
}
 