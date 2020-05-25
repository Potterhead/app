<?php

include 'SpellNotFound.php';

class Spell
{

  const VALID_TYPES = [
    'Charm',
    'Enchantment',
    'Spell',
    'Hex',
    'Curse',
    'Jinx'
  ];

  public $spell;
  public $type;
  public $effect;

  public function setType($type){
    if (!in_array($type, self::VALID_TYPES)) {
      throw new SpellNotFound('Böyle bir büyü tipi yok');
    }
    $this->type = $type;

  }



}
