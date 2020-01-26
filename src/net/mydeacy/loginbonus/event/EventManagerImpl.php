<?php

namespace net\mydeacy\loginbonus\event;

use net\mydeacy\loginbonus\interfaces\EventManager;
use net\mydeacy\loginbonus\LoginBonus;

class EventManagerImpl implements EventManager {

	/**
	 * @var LoginBonus
	 */
	private $plugin;

	/**
	 * EventManagerImpl constructor.
	 *
	 * @param LoginBonus $plugin
	 */
	public function __construct(LoginBonus $plugin) {
		$this->plugin = $plugin;
	}

	/**
	 * @inheritDoc
	 */
	public function getPlugin() :LoginBonus {
		return $this->plugin;
	}

	/**
	 * @inheritDoc
	 */
	public function registerHandler(EventHandler $handler) :void {
		$this->plugin->getServer()->getPluginManager()->registerEvents($handler, $this->plugin);
		$handler->setEventManager($this);
	}
}