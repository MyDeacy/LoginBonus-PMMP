<?php

namespace net\mydeacy\loginbonus\event;

use net\mydeacy\loginbonus\form\forms\SimpleForm;
use net\mydeacy\loginbonus\LoginUser;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;

class LoginBonusEvent extends EventHandler {

	const FORMAT = "Y-m-d";

	private $formView = [];

	/**
	 * @param PlayerLoginEvent $event
	 *
	 * @priority HIGHEST
	 * @softDepend EconomyAPI
	 * @ignoreCancelled
	 */
	function onLogin(PlayerLoginEvent $event) {
		$plugin = $this->getEventManager()->getPlugin();
		$now = (new \DateTime())->format(self::FORMAT);
		$name = $event->getPlayer()->getName();
		$config = $plugin->getConfig();
		$user = $plugin->getRepository()->getLoginUser($name);
		$message = "";
		if ($user === null) {
			$user = new LoginUser();
			$user->setLoginCount(1)
			     ->setLastLogin($now)
			     ->setPlayerName($name);
			$plugin->getRepository()->registerLoginUser($user);
		} elseif ($user->getLastLogin() === $now) {
			return;
		}
		$bonus = (int)$config->get("bonus");
		$yesterday = (new \DateTime())->modify("-1 days")->format(self::FORMAT);
		if ($user->getLastLogin() === $yesterday) {
			$user->setLoginCount($user->getLoginCount() + 1);
			if ($user->getLoginCount() % (int)$config->get("period-count") === 0) {
				$bonus += (int)$config->get("period-bonus");
			}
		} else {
			$user->setLoginCount(1);
		}
		$user->setLastLogin($now);
		$plugin->getRepository()->setLoginUser($user);
		$economy = EconomyAPI::getInstance();
		$economy->addMoney($name, (int)$bonus);
		$message .= str_replace("{%1}", $user->getLoginCount(), $config->get("period-message")) . "\n";
		$message .= str_replace("{%1}", $economy->getMonetaryUnit() . $bonus, $config->get("send-bonus-message"). "\n");
		$this->formView[$name] = $message;
	}

	/**
	 * @param PlayerMoveEvent $event
	 */
	function onMove(PlayerMoveEvent $event) {
		$player = $event->getPlayer();
		if (!isset($this->formView[$player->getName()])) {
			return;
		}
		$name = $player->getName();
		$packet = new ModalFormRequestPacket();
		$packet->formId = rand(10000, 999999);
		$form = (new SimpleForm())
			->setTitle($this->getEventManager()->getPlugin()->getConfig()->get("form-title"))
			->setContent($this->formView[$name])
			->addButton("OK");
		$packet->formData = json_encode($form->getData());
		$player->dataPacket($packet);
		unset($this->formView[$name]);
	}
}