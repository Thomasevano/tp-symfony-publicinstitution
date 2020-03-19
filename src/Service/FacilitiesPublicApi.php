<?php

namespace App\Service;

class FacilitiesPublicApi {
    public function getFacilities($code_commune) {
        $ch = curl_init();
        $options = [];

        $options = array(CURLOPT_URL => "https://etablissements-publics.api.gouv.fr/v3/communes/$code_commune/mairie",
            CURLOPT_RETURNTRANSFER => true
        );

        curl_setopt_array($ch, $options);
        $res = json_decode(curl_exec($ch),true);
        return $res;
    }
}
