<?php

class Character
{
    public $name;
    
    private $dumbledoresArmy = false;
    
    public function __construct($name, $dumbledoresArmy)
    {
        $this->name = $name;
        $this->dumbledoresArmy = $dumbledoresArmy;
    }
}
