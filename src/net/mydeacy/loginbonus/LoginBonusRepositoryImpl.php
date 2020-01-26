<?php

namespace net\mydeacy\loginbonus;

use net\mydeacy\loginbonus\interfaces\LoginBonusRepository;
use net\mydeacy\loginbonus\LoginUser;

class LoginBonusRepositoryImpl implements LoginBonusRepository {

	const FILE_NAME = "login.sqlite3";

	/**
	 * @var \SQLite3
	 */
	private $db;

	public function __construct(LoginBonus $main) {
		$dir = $main->getDataFolder();
		$this->db = new \SQLite3($dir. self::FILE_NAME);
		$this->db->exec("CREATE TABLE IF NOT EXISTS login (
			name TEXT NOT NULL PRIMARY KEY,
			lastLogin TEXT NOT NULL,
			count INTEGER NOT NULL
		)");
	}

	/**
	 * @inheritDoc
	 */
	function getLoginUser(string $userName) :?LoginUser {
		$stmt = $this->db->prepare("SELECT * FROM login WHERE name = :name");
		$stmt->bindValue(":name", $userName);
		$result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
		return $this->crateLoginUser($result);
	}

	/**
	 * @inheritDoc
	 */
	function setLoginUser(LoginUser $user) :void {
		$stmt = $this->db->prepare("UPDATE login SET lastLogin = :lastLogin, count = :count WHERE name = :name");
		$stmt->bindValue(":lastLogin", $user->getLastLogin());
		$stmt->bindValue(":count", $user->getLoginCount());
		$stmt->bindValue(":name", $user->getPlayerName());
		$stmt->execute();
	}

	/**
	 * @inheritDoc
	 */
	function registerLoginUser(LoginUser $user) :void {
		$stmt = $this->db->prepare("INSERT INTO login (name, lastLogin, count) VALUES (:name, :lastLogin, :count)");
		$stmt->bindValue(":lastLogin", $user->getLastLogin());
		$stmt->bindValue(":count", $user->getLoginCount());
		$stmt->bindValue(":name", $user->getPlayerName());
		$stmt->execute();
	}

	/**
	 * @param array $result
	 *
	 * @return LoginUser|null
	 */
	private function crateLoginUser($result) : ?LoginUser {
		if(!$result){
			return null;
		}
		$user = new LoginUser();
		$user->setPlayerName($result["name"]);
		$user->setLastLogin($result["lastLogin"]);
		$user->setLoginCount($result["count"]);
		return $user;
	}
}