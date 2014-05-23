<?php

namespace Jazzyweb\Geo\Tests;


use Jazzyweb\Geo\AddressToLonLat;

class AddressToLonLatTest extends \PHPUnit_Framework_TestCase
{
    public function testAddressesOk()
    {
        $address1 = "Calle Amalarico, 29, Madrid";
        $address2 = "Calle Paseo San Antón, 12, Camona/Sevilla";

        $a2l1 = new AddressToLonLat($address1);
        $a2l2 = new AddressToLonLat($address2);

        $this->assertEquals(-3.73, round($a2l1->getLon(),2));
        $this->assertEquals(40.39, round($a2l1->getLat(),2));

        $this->assertEquals("COMPUTED", $a2l1->getStatus());

        $this->assertEquals(-5.65, round($a2l2->getLon(),2));
        $this->assertEquals(37.47, round($a2l2->getLat(),2));

        $this->assertEquals("COMPUTED", $a2l2->getStatus());
    }

    public function testAddressesNoOK(){

        $address1 = "~~~~~~~";
        $a2l1 = new AddressToLonLat($address1);

        $a2l1->getLon();

        $this->assertEquals("FAIL", $a2l1->getStatus());
    }
}