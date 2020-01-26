<?php

namespace net\mydeacy\loginbonus;

use net\mydeacy\loginbonus\event\EventManagerImpl;
use net\mydeacy\loginbonus\event\LoginBonusEvent;
use net\mydeacy\loginbonus\interfaces\EventManager;
use net\mydeacy\loginbonus\interfaces\LoginBonusRepository;
use pocketmine\plugin\PluginBase;

class LoginBonus extends PluginBase {

	/**
	 * @var EventManager
	 */
	private $eventManager;

	/**
	 * @var LoginBonusRepository
	 */
	private $repository;

	public function onEnable() {
		$this->saveDefaultConfig();
		$this->eventManager = new EventManagerImpl($this);
		$this->repository = new LoginBonusRepositoryImpl($this);
		$this->eventManager->registerHandler(new LoginBonusEvent());
	}

	/**
	 * @return LoginBonusRepository
	 */
	public function getRepository() :LoginBonusRepository {
		return $this->repository;
	}
}