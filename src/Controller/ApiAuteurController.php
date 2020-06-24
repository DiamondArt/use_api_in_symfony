<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Repository\AuteurRepository;
use App\Repository\NationaliteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/biblio")
 */

class ApiAuteurController extends AbstractController
{

    /**
     * @Route("/auteurs", name="auteur_liste", methods={"GET"})
     * @param AuteurRepository $repo
     * @param SerializerInterface $serializer
     * @return void
     */
    public function getAuteurs(AuteurRepository $repo, SerializerInterface $serializer)
    {
        $auteurs = $repo->findAll();
        $auteur = $serializer->serialize($auteurs, 'json',
        [
            'groups' => ['ListeAuteurs']
         ]);

        return new JsonResponse($auteur,Response::HTTP_OK,[], true);

    }

    /**
     * @Route("/auteurs/{id}", name="auteur_liste_by_id", methods={"GET"})
     * @param Auteur $auteur
     * @param SerializerInterface $serializer
     * @return void
     */
    public function getAuteurById(Auteur $auteur, SerializerInterface $serializer)
    {
        $auteurs = $serializer->serialize($auteur, 'json',
        [
            'groups' => ['ListeAuteurs']
         ]);

        return new JsonResponse($auteurs,Response::HTTP_OK,[], true);
    }

    /**
     * @Route("/auteurs", name="create_auteur", methods={"POST"})
     * @param Request $request
     * @param ManagerRegistry $managerRegistry
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @return void
     */
    public function create(Request $request,NationaliteRepository $repoNat, ManagerRegistry $managerRegistry, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $data = $request->getContent();
        $dataTable = $serializer->decode($data,'json');
        $auteur = new Auteur();

        $nationnalite = $repoNat->find($dataTable['nationalite']['id']);

        $auteur = $serializer->deserialize($data, Auteur::class,'json', ['object_to_populate' => $auteur]);
        $auteur->setNationalite($nationnalite);

        $errors =  $validator->validate($auteur);

        if (count($errors)){

            $errorsJson = $serializer->serialize($errors,'json');
            return new JsonResponse($errorsJson, Response::HTTP_BAD_REQUEST,[],true);

        }

        $manager = $managerRegistry->getManager();
        $manager->persist($auteur);
        $manager->flush();

        return new JsonResponse(null,Response::HTTP_CREATED,
         ['location' => $this->generateUrl("auteur_liste_by_id",["id" => $auteur->getId(),
         urlGeneratorInterface::ABSOLUTE_URL])
         ]
        );
    }

    /**
     * @Route("/auteurs/{id}", name="update_auteur", methods={"PUT"})
     * @param Request $request
     * @param Auteur $auteur
     * @param ValidatorInterface $validator
     * @param ManagerRegistry $managerRegistry
     * @param SerializerInterface $serializer
     * @return void
     */
    public function update(Request $request,NationaliteRepository $repoNat, Auteur $auteur,ManagerRegistry $managerRegistry,ValidatorInterface $validator ,SerializerInterface $serializer)
    {
        $data = $request->getContent();
        $dataTable = $serializer->decode($data,'json');
        $manager = $managerRegistry->getManager();

        $nationnalite = $repoNat->find($dataTable['nationalite']['id']);

        $auteur = $serializer->deserialize($data, Auteur::class,'json', ['object_to_populate' => $auteur]);
        $auteur->setNationalite($nationnalite);

        $errors =  $validator->validate($auteur);

        if (count($errors)) {

            $errorsJson = $serializer->serialize($errors,'json');
            return new JsonResponse($errorsJson, Response::HTTP_BAD_REQUEST,[],true);
        }

        $manager->persist($auteur);
        $manager->flush();

        return new JsonResponse('',Response::HTTP_OK,[], true);
    }

    /**
     * @Route("/auteurs/{id}", name="delete_auteur", methods={"DELETE"})
     * @param Auteur $auteur
     * @param ManagerRegistry $managerRegistry
     * @return void
     */
    public function delete(Auteur $auteur, ManagerRegistry $managerRegistry)
    {
        $manager = $managerRegistry->getManager();
        $manager->remove($auteur);
        $manager->flush();

        return new JsonResponse('',Response::HTTP_OK,[]);
    }
}
