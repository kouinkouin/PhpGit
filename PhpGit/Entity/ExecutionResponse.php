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
	 * @param string $output
	 * @param float $executionTime
	 */
	public function __construct($returnCode, $output, $executionTime) {
		$this->returnCode = (int) $returnCode;
		$this->setOutput($output);
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
	 * Translates and sets the output from string to array
	 * @param string $output
	 */
	private function setOutput($output) {
		$this->output = explode(PHP_EOL, $output);
		if(strlen(end($this->output))===0) {
			array_pop($this->output);
		}
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
 