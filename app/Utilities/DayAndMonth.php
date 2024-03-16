<?php

namespace App\Utilities;

use Illuminate\Support\Carbon;

class DayAndMonth
{

    private static $monthPerYear = [
        "January" => "January",
        "Feberary" => "Feberary",
        "March" => "March",
        "April" => "April",
        "May" => "May",
        "June" => "June",
        "July" => "July",
        "August" => "August",
        "Septempber" => "Septempber",
        "October" => "October",
        "November" => "November",
        "December" => "December",
    ];

    public static function dd(){
        
        $time = Carbon::createFromFormat('Y-m-d', '2024-01-06')->year;
        // dd($time);
    }

    public static function generateMonthsPerYear()
    {
        return self::$monthPerYear;
    }

    public static function valueArray () 
    {
       return array_values(self::$monthPerYear);
    }
}