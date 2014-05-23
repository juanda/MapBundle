<?php

namespace Jazzyweb\MapBundle;


interface MarkerInterface {
    public function getLon();
    public function getLat();
    public function getContent();
    public function getAddress();
} 