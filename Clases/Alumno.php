<?php
require_once 'Persona.php';
class Alumno extends Persona
{
    $legajo;

    public function _construct($legajo)
    {
        parent::_construct($name,$lastname);
        this->$legajo = $legajo;
    }
    
}