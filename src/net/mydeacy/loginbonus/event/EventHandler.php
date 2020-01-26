<?php

namespace net\mydeacy\loginbonus\event;

use net\mydeacy\loginbonus\interfaces\EventManager;
use pocketmine\event\Listener;

abstract class EventHandler implements Listener {

	/**
	 * @var EventManager
	 */
	private $manager = null;

	/**
	 * @param EventManager $manager
	 */
	final public function setEventManager(EventManager $manager) :void {
		$this->manager = $manager;
	}

	/**
	 * @return EventManager|null
	 */
	final protected function getEventManager() :?EventManager {
		return $this->manager;
	}
}