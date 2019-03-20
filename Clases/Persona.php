<?php
require_once 'Humano.php';
class Persona extends Humano
{
    public $dni;
    public function _construct($dni)
    {
        parent::_construct($name,$lastname);
        this->$dni = $dni;
    }
}