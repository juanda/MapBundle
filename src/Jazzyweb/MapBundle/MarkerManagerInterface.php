<?php
namespace Jazzyweb\MapBundle;


interface MarkerManagerInterface {
    public function getAll();
    public function getAllByProvincia($p);
    public function getAllByComunidad($c);
    public function getAllByMunicipio($m);
} 