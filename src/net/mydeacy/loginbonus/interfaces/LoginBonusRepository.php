<?php

namespace net\mydeacy\loginbonus\interfaces;

use http\Client\Curl\User;
use net\mydeacy\loginbonus\LoginUser;

interface LoginBonusRepository {

	/**
	 * @param string $userName
	 *
	 * @return LoginUser|null
	 */
	function getLoginUser(string $userName) :?LoginUser;

	/**
	 * @param LoginUser $user
	 *
	 * @throws \SQLiteException
	 */
	function setLoginUser(LoginUser $user) :void;

	/**
	 * @param LoginUser $user
	 *
	 * @throws \SQLiteException
	 */
	function registerLoginUser(LoginUser $user) :void;

}