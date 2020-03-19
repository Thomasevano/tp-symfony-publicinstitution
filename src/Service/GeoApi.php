<?php

namespace App\Service;

class GeoApi {
    public function getCommune($zipcode, $city_name): array
    {
        $ch = curl_init();
        $options = [];

        if($city_name === "") {
            $options = array(CURLOPT_URL => "https://geo.api.gouv.fr/communes?codePostal=$zipcode&fields=&format=json&geometry=centre",
                CURLOPT_RETURNTRANSFER => true
            );
        }
        else if($zipcode === "") {
            $options = array(CURLOPT_URL => "https://geo.api.gouv.fr/communes?nom=$city_name&fields=&format=json&geometry=centre",
                CURLOPT_RETURNTRANSFER => true
            );
        }
        else {
            $options = array(CURLOPT_URL => "https://geo.api.gouv.fr/communes?codePostal=$zipcode&nom=$city_name&fields=&format=json&geometry=centre",
                CURLOPT_RETURNTRANSFER => true
            );
        }

        curl_setopt_array($ch, $options);
        $res = json_decode(curl_exec($ch),true);
//        try {
//        }
//        catch (Exception $e) {
//            return "Les API ne sont pas disponibles";
//        }
        return $res;
    }
}


