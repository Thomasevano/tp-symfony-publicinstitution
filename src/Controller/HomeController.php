<?php

namespace App\Controller;

use App\Service\FacilitiesPublicApi;
use App\Service\GeoApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param GeoAPi $geoAPi
     * @param FacilitiesPublicApi $publicFacilities
     */

    public function index(GeoApi $geoApi, FacilitiesPublicApi $publicFacilities)
    {
        $getCity = [];
        $error_message = '';
        if($_GET){
            $city_name = $_GET["city_name"];
            $zipcode = $_GET["zipcode"];
            $cities = $geoApi->getCommune($zipcode,str_replace(' ','-',$city_name));
            foreach ($cities as $city) {
                $facilities = $publicFacilities->getFacilities($city['code']);
                if($facilities != null) {
                    $city['etablissement'] = $facilities;
                }
                array_push($getCity,$city);
            }
            if($cities == []) {
                $error_message = "Aucune ville trouvé.";
            }

            return $this->render('base.html.twig', [
                'cities' => $getCity,
                'zipcode' => $zipcode,
                'city_name' => $city_name,
                'error_message' => $error_message

            ]);

        }
        else {
            return $this->render('base.html.twig', [
                'cities' => $getCity,
                'zipcode' => '',
                'city_name' => '',
                'error_message' => $error_message

            ]);
        }
    }
}
