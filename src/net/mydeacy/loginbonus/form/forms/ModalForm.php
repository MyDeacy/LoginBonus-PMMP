<?php

namespace net\mydeacy\loginbonus\form\forms;

class ModalForm extends Window {

	public function __construct() {
		$this->data = [
			"type"    => "modal",
			"title"   => "",
			"content" => "",
			"button1" => "",
			"button2" => ""
		];
	}

	public function setTitle(String $title) {
		$this->data["title"] = $title;
		return $this;
	}

	public function setContent(String $text) {
		$this->data["content"] = $text;
		return $this;
	}

	public function setButton1(String $text) {
		$this->data["button1"] = $text;
		return $this;
	}

	public function setButton2(String $text) {
		$this->data["button2"] = $text;
		return $this;
	}
}