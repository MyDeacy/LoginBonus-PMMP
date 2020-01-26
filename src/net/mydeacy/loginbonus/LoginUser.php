<?php

namespace net\mydeacy\loginbonus;

class LoginUser {

	/**
	 * @var string
	 */
	private $playerName;

	/**
	 * @var string
	 */
	private $lastLogin;

	/**
	 * @var int
	 */
	private $loginCount;

	/**
	 * @return string
	 */
	public function getPlayerName() :string {
		return $this->playerName;
	}

	/**
	 * @param string $playerName
	 */
	public function setPlayerName(string $playerName) :self {
		$this->playerName = $playerName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLastLogin() :string {
		return $this->lastLogin;
	}

	/**
	 * @param string $lastLogin
	 */
	public function setLastLogin(string $lastLogin) :self {
		$this->lastLogin = $lastLogin;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getLoginCount() :int {
		return $this->loginCount;
	}

	/**
	 * @param int $loginCount
	 */
	public function setLoginCount(int $loginCount) :self {
		$this->loginCount = $loginCount;
		return $this;
	}
}