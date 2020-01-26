<?php

namespace net\mydeacy\loginbonus\interfaces;

use net\mydeacy\loginbonus\event\EventHandler;
use net\mydeacy\loginbonus\LoginBonus;

interface EventManager {

	/**
	 * @return LoginBonus
	 */
	function getPlugin(): LoginBonus;

	/**
	 * @param EventHandler $handler
	 */
	function registerHandler(EventHandler $handler): void;
}