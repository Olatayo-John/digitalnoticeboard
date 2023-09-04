<?php
namespace App\Helpers;

class Helper {

    public static function randomNumber(){
        return mt_rand(100001, 999999);
    }

    public static function ConvertGMTToLocalTimezone($gmttime, $timezoneRequired){
        $system_timezone = date_default_timezone_get();

        date_default_timezone_set("GMT");
        $gmt = date("Y-m-d H:i:s");

        $local_timezone = $timezoneRequired;
        date_default_timezone_set($local_timezone);
        $local = date("Y-m-d H:i:s");

        date_default_timezone_set($system_timezone);
        $diff = (strtotime($local) - strtotime($gmt));

        $date = new \DateTime($gmttime);
        $date->modify("+$diff seconds");

        //$timestamp = $date->format("m-d-Y H:i:s");
        //return $timestamp;

        return $date;
    }

    public static function ConvertLocalTimezoneToGMT($gmttime, $timezoneRequired){
        $system_timezone = date_default_timezone_get();

        $local_timezone = $timezoneRequired;
        date_default_timezone_set($local_timezone);
        $local = date("Y-m-d H:i:s");

        date_default_timezone_set("GMT");
        $gmt = date("Y-m-d H:i:s");

        date_default_timezone_set($system_timezone);
        $diff = (strtotime($gmt) - strtotime($local));

        $date = new \DateTime($gmttime);
        $date->modify("+$diff seconds");

        // $timestamp = $date->format("m-d-Y H:i:s");
        $timestamp = $date->format("Y-m-d H:i:s");
        return $timestamp;

        //return $date;
    }


}
