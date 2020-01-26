<?php

namespace net\mydeacy\loginbonus\form\forms;

use net\mydeacy\loginbonus\form\elements\Element;

class CustomForm extends Window {

	public function __construct() {
		$this->data = [
			"type"    => "custom_form",
			"title"   => "",
			"content" => []
		];
	}

	public function setTitle(String $title) {
		$this->data["title"] = $title;
		return $this;
	}

	/*----- Elements -----*/
	public function addContent(Element $element) {
		$this->data["content"][] = $element->content();
		return $this;
	}
}
