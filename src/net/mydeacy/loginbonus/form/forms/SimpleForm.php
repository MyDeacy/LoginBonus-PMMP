<?php

namespace net\mydeacy\loginbonus\form\forms;

class SimpleForm extends Window {

	public function __construct() {
		$this->data = [
			"type"    => "form",
			"title"   => "",
			"content" => "",
			"buttons" => []
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

	public function addButton(String $text, $image = null) {
		if ($image !== null) {
			$this->data["buttons"][] = [
				"text"  => $text,
				"image" => [
					"type" => "url",
					"data" => $image
				]
			];
		} else {
			$this->data["buttons"][] = [
				"text" => $text
			];
		}
		return $this;
	}
}