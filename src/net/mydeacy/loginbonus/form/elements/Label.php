<?php

namespace net\mydeacy\loginbonus\form\elements;

class Label extends BaseElement {

  const TYPE = "label";

  public function content() {
    return [
      "type" => self::TYPE,
      "text" => $this->text
    ];
  }
}
