<?php

namespace Swissplaces\Tests;

use Swissplaces\District;

class DistrictTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param     $value
     * @param int $min
     * @param int $max
     *
     * @return bool
     */
    private static function isBetween($value, $min, $max)
    {
        return $value <= $max && $value >= $min;
    }

    /** @test */
    public function it_returns_all_postalcodes_if_no_paramter_is_given()
    {
        $this->assertTrue(count(District::getPostalcodes()) > 2500);
    }

    /** @test */
    public function it_returns_all_postalcodes_of_all_districts_if_just_the_canton_is_given()
    {
        $this->assertTrue(self::isBetween(count(District::getPostalcodes('TG')), 75, 85));
        $this->assertTrue(self::isBetween(count(District::getPostalcodes([ 'TG' ])), 75, 85));
        $this->assertTrue(self::isBetween(count(District::getPostalcodes([ 'TG' => [ ] ])), 75, 85));
    }

    /** @test */
    public function it_returns_all_postalcodes_of_all_districts_if_just_the_cantons_are_given()
    {
        $this->assertTrue(self::isBetween(count(District::getPostalcodes('TG;LU')), 220, 230));
        $this->assertTrue(self::isBetween(count(District::getPostalcodes([ 'TG', 'LU' ])), 220, 230));
        $this->assertTrue(self::isBetween(count(District::getPostalcodes([ 'TG' => [ ], 'LU' => [] ])), 220, 230));
    }

    /** @test */
    public function it_returns_the_postalcodes_of_the_given_district()
    {
        $this->assertTrue(self::isBetween(count(District::getPostalcodes('TG:Arbon')), 10, 15));
        $this->assertTrue(self::isBetween(count(District::getPostalcodes([ 'TG' => [ 'Arbon' ] ])), 10, 15));
    }

    /** @test */
    public function it_returns_the_postalcodes_of_the_given_districts()
    {
        $this->assertTrue(self::isBetween(count(District::getPostalcodes('TG:Arbon,Kreuzlingen')), 25, 30));
        $this->assertTrue(self::isBetween(count(District::getPostalcodes([ 'TG' => [ 'Arbon' ], 'AG' => [ 'Aarau', 'Brugg' ] ])), 45, 55));
    }

    /** @test */
    public function it_returns_the_postalcodes_of_the_given_districts_and_all_postalcodes_of_all_districts_of_the_given_canton()
    {
        $this->assertTrue(self::isBetween(count(District::getPostalcodes('AG:Aarau,Brugg;LU')), 170, 180));
        $this->assertTrue(self::isBetween(count(District::getPostalcodes([ 'AG' => [ 'Aarau', 'Brugg' ], 'LU' ])), 170, 180));
        $this->assertTrue(self::isBetween(count(District::getPostalcodes([ 'AG' => [ 'Aarau', 'Brugg' ], 'LU' => [ ] ])), 170, 180));
    }
}