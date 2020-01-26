<?php

namespace net\mydeacy\loginbonus;

use net\mydeacy\loginbonus\event\EventManagerImpl;
use net\mydeacy\loginbonus\event\LoginBonusEvent;
use net\mydeacy\loginbonus\interfaces\LoginBonusRepository;
use pocketmine\plugin\PluginBase;

class LoginBonus extends PluginBase {

	/**
	 * @var LoginBonusRepository
	 */
	private $repository;

	public function onEnable() {
		$this->saveDefaultConfig();
		$eventManager = new EventManagerImpl($this);
		$this->repository = new LoginBonusRepositoryImpl($this);
		$eventManager->registerHandler(new LoginBonusEvent());
	}

	/**
	 * @return LoginBonusRepository
	 */
	public function getRepository() :LoginBonusRepository {
		return $this->repository;
	}
}