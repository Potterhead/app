<?php

include 'HouseNotFound.php';
include 'WrongIdTypeException.php';

class House
{
    const VALID_HOUSES = [
        'Gryffindor',
        'Ravenclaw',
        'Slytherin',
        'Hufflepuff'
    ];

    public $id;
    public $name;
    public $founder;
    public $headOfHouse;
    public $mascot;
    public $houseGhost;
    public $school;
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function setName($name)
    {
        if (!in_array($name, self::VALID_HOUSES)) {
            throw new HouseNotFound('Bina bulunamıyor');
        }

        $this->name = $name;

        return $this;
    }
    
    public function setFounder($founder)
    {
        $founder = explode(' ', $founder);
    
        $this->founder = $founder[1];
    }
    
    public function getFounder()
    {
        return $this->founder;
    }
}
