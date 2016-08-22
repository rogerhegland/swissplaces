<?php

namespace Swissplaces;

class Canton
{
    /**
     * @param string|array $cantonAbbreviations
     * Comma separated list or array of the needed cantons
     *
     * @return array
     */
    public static function getPostalcodes($cantonAbbreviations = null)
    {
        if (is_null($cantonAbbreviations)) {
            foreach (Swissplace::$_cantons as $abbreviation => $postalcode) {
                $cantonAbbreviations[] = $abbreviation;
            }
        }

        if (is_string($cantonAbbreviations)) {
            $cantonAbbreviations = explode(',', $cantonAbbreviations);
        }

        $cantonAbbreviations = array_map('strtoupper', $cantonAbbreviations);

        $postalcodes = [ ];
        foreach (Swissplace::$_cantons as $abbreviation => $postalcode) {
            if (in_array($abbreviation, $cantonAbbreviations)) {
                $postalcodes = array_merge($postalcodes, explode(',', $postalcode['zip']));
            }
        }

        return $postalcodes;
    }
}