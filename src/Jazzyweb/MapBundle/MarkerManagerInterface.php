<?php
namespace Jazzyweb\MapBundle;


interface MarkerManagerInterface {
    public function getAll();
    public function getAllByProvincia($p);
    public function getAllByAutonomia($a);
    public function getAllByLocalidad($l);
} 