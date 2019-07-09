<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class CountryModel extends Model {

    /**
     * Get the list of all countries
     * @return type
     */
    public static function getCountriesList() {
        $oCountries = DB::table('tbl_countries')
                ->get();
        return $oCountries;
    }

}
