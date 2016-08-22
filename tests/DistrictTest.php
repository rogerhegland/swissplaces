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
}