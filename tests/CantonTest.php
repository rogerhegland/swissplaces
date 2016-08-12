<?php

use Swissplaces\Canton;

class CantonTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_all_postalcodes_if_no_parameter_is_given()
    {
        $this->assertTrue(count(Canton::getPostalcodes()) > 3490);
    }

    /** @test */
    public function it_returns_the_postalcodes_from_the_given_canton()
    {
        $number = count(Canton::getPostalcodes('TG'));
        $this->assertTrue($number > 120 && $number < 130);
    }

    /** @test */
    public function it_returns_the_postalcodes_from_the_given_cantons()
    {
        $number = count(Canton::getPostalcodes('TG,SG,AG'));
        $this->assertTrue($number > 560 && $number < 580);

        $number = count(Canton::getPostalcodes([ 'TG', 'SG', 'AG' ]));
        $this->assertTrue($number > 560 && $number < 580);
    }

    /** @test */
    public function the_function_is_case_insensitivity()
    {
        $number = count(Canton::getPostalcodes('tg'));
        $this->assertTrue($number > 120 && $number < 130);

        $number = count(Canton::getPostalcodes('Tg'));
        $this->assertTrue($number > 120 && $number < 130);
    }
}