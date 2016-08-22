<?php

namespace Swissplaces;

class District
{
    /**
     * @param string|array $cantonsAndDistricts
     * - ZH:district1,district2;TG:district3,district4
     * - [ 'ZH' => [ 'district1', 'district2' ], 'TG' => [ 'district3', 'district4' ] ]
     *
     * => Returns the postalcodes from the districts 'district1' and 'district2' of canton Zurich and these from the districts 'district3' and 'district4' of canton Thurgau.
     *
     * - ZH;TG;LU:district1
     * - [ 'ZH', 'TG' => [], 'LU' => 'district1' ]
     *
     * => Returns the postalcodes from all districts of the cantons Zurich and Thurgau and these from the district 'district1' of Canton Lucerne.
     *
     * @return array
     */
    public static function getPostalcodes($cantonsAndDistricts = null)
    {
        $cantons = [ ];

        if (is_null($cantonsAndDistricts)) {
            foreach (Swissplace::$_cantons as $cantonName => $cantonValues) {
                foreach ($cantonValues['districts'] as $districtName => $districtValue) {
                    $cantonsAndDistricts[$cantonName][] = $districtName;
                }
            }
        }

        if (is_string($cantonsAndDistricts)) {
            $cantonsWithDistricts = explode(';', $cantonsAndDistricts);
            $cantonsAndDistricts = [ ];
            foreach ($cantonsWithDistricts as $cantonsWithDistrict) {
                $districts = substr($cantonsWithDistrict, 3);
                if ($districts) {
                    $districts = explode(',', $districts);
                } else {
                    $districts = [ ];
                }
                $cantonsAndDistricts[substr($cantonsWithDistrict, 0, 2)] = $districts;
            }
        }

        $cantonsDistricts = $cantonsAndDistricts;
        $cantonsAndDistricts = [ ];
        foreach ($cantonsDistricts as $canton => $districts) {
            if ( ! is_string($canton)) {
                $canton = $districts;
                $districts = [ ];
            }

            if ( ! count($districts)) {
                $districtsOfCanton = [ ];
                foreach (Swissplace::$_cantons[$canton]['districts'] as $districtName => $districtValue) {
                    $districtsOfCanton[] = $districtName;
                }

                $cantonsAndDistricts[$canton] = $districtsOfCanton;
            } else {
                $cantonsAndDistricts[$canton] = $districts;
            }
        }

        foreach ($cantonsAndDistricts as $cantonAbbreviation => $cantonDistricts) {
            $cantons[] = $cantonAbbreviation;
        }

        $postalCodes = [ ];
        foreach (Swissplace::$_cantons as $cantonAbbreviation => $cantondata) {
            if ( ! in_array($cantonAbbreviation, $cantons)) {
                continue;
            }

            foreach ($cantondata['districts'] as $districtName => $zipsOfDistrict) {
                if ( ! in_array($districtName, $cantonsAndDistricts[$cantonAbbreviation])) {
                    continue;
                }

                $postalCodes = array_merge($postalCodes, explode(',', $zipsOfDistrict['zip']));
            }
        }

        return $postalCodes;
    }
}