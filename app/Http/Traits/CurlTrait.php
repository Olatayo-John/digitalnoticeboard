<?php

namespace App\Http\Traits;

Trait CurlTrait{

    public function getCountryList(){
        $apiKey = env('GEONAMES_API_KEY');

        $url = "http://api.geonames.org/countryInfoJSON?username=$apiKey";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        // Check for errors
        if ($data === null || isset($data['status']['message'])) {
            return [];
        } else {
            return $data['geonames'];
        }
    }

    public function getCountryStateList(){
        $apiKey = env('GEONAMES_API_KEY');
        $geoNameId = request('geoNameId');

        $url = "http://api.geonames.org/childrenJSON?geonameId=$geoNameId&username=$apiKey";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        // Check for errors
        if ($data === null || isset($data['status']['message'])) {
            return [];
        } else {
            return $data['geonames'];
        }
    }

}