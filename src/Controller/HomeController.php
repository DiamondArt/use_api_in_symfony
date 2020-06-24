<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * list regions function
     *@Route("/regions", name="regions_liste", )
     */
    public function index(SerializerInterface $serializer)
    {
        $regions = file_get_contents('https://geo.api.gouv.fr/regions');
       // $tableRegions = $serializer->decode($regions, 'json');

        //$objetRegions = $serializer->denormalize($tableRegions, 'App\Entity\Regions[]');

        $region = $serializer->deserialize($regions, 'App\Entity\Regions[]','json');

       // var_dump($objetRegions);
       // die();
        return $this->render('home.html.twig',
        [
            "tablesRegions" => $region
        ]);
    }

    /**
     * Undocumented function
     * @Route("/listDep", name="region_by_departements")
     * @return void
     */
    public function getRegions(Request $request,SerializerInterface $serializer)
    {
        $codeRegion = $request->query->get('region');
        $regions = file_get_contents('https://geo.api.gouv.fr/regions');
        $regions = $serializer->deserialize($regions, 'App\Entity\Regions[]', 'json');

        if($codeRegion == null || $codeRegion == "Toutes")
        {
            $departements = file_get_contents('https://geo.api.gouv.fr/departements');

        }else{
            $departements = file_get_contents('https://geo.api.gouv.fr/regions/'.$codeRegion.'/departements');

        }
        $departements= $serializer->decode($departements, 'json');

        return $this->render('listDepRegion.html.twig',
        [
            'departements' => $departements,
            'regions' => $regions
        ]);
    }
}
