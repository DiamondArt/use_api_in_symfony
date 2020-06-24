<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/biblio")
 */

class ApiGenreController extends AbstractController
{

    /**
     * @Route("/genres", name="genre_liste", methods={"GET"})
     * @param GenreRepository $repo
     * @param SerializerInterface $serializer
     * @return void
     */
    public function getGenres(GenreRepository $repo, SerializerInterface $serializer)
    {
        $genres = $repo->findAll();
        $genre = $serializer->serialize($genres, 'json',
        [
            'groups' => ['ListeGenreFull']
         ]);

        return new JsonResponse($genre,Response::HTTP_OK,[], true);

    }

    /**
     * @Route("/genres/{id}", name="genre_liste_by_id", methods={"GET"})
     * @param Genre $genre
     * @param SerializerInterface $serializer
     * @return void
     */
    public function getGenreById(Genre $genre, SerializerInterface $serializer)
    {
        $genres = $serializer->serialize($genre, 'json',
        [
            'groups' => ['ListeGenreFull']
         ]);

        return new JsonResponse($genres,Response::HTTP_OK,[], true);
    }

    /**
     * @Route("/genres", name="create_genre", methods={"POST"})
     * @param Request $request
     * @param ManagerRegistry $managerRegistry
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @return void
     */
    public function create(Request $request, ManagerRegistry $managerRegistry, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $data = $request->getContent();
        $manager = $managerRegistry->getManager();
 
        var_dump($data);
        $genre = $serializer->deserialize($data, Genre::class,'json');

        $errors =  $validator->validate($genre);

        if (count($errors)) {

            $errorsJson = $serializer->serialize($errors,'json');
            return new JsonResponse($errorsJson, Response::HTTP_BAD_REQUEST,[],true);
        }

        $manager->persist($genre);
        $manager->flush();

        return new JsonResponse(null,Response::HTTP_CREATED,
         ['location' => $this->generateUrl("genre_liste_by_id",["id" => $genre->getId(),
         urlGeneratorInterface::ABSOLUTE_URL])
         ]
        );
    }

    /**
     * @Route("/genres/{id}", name="update_genre", methods={"PUT"})
     * @param Request $request
     * @param Genre $genre
     * @param ValidatorInterface $validator
     * @param ManagerRegistry $managerRegistry
     * @param SerializerInterface $serializer
     * @return void
     */
    public function update(Request $request,Genre $genre,ManagerRegistry $managerRegistry,ValidatorInterface $validator ,SerializerInterface $serializer)
    {
        $data = $request->getContent();
        $manager = $managerRegistry->getManager();

        $genre = $serializer->deserialize($data, Genre::class,'json', ['object_to_populate' => $genre]);

        $errors =  $validator->validate($genre);

        if (count($errors)) {

            $errorsJson = $serializer->serialize($errors,'json');
            return new JsonResponse($errorsJson, Response::HTTP_BAD_REQUEST,[],true);
        }

        $manager->persist($genre);
        $manager->flush();

        return new JsonResponse('',Response::HTTP_OK,[], true);
    }

    /**
     * @Route("/genres/{id}", name="delete_genre", methods={"DELETE"})
     * @param Genre $genre
     * @param ManagerRegistry $managerRegistry
     * @return void
     */
    public function delete(Genre $genre, ManagerRegistry $managerRegistry)
    {
        $manager = $managerRegistry->getManager();
        $manager->remove($genre);
        $manager->flush();

        return new JsonResponse('',Response::HTTP_OK,[]);
    }
}
