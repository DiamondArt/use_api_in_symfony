<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/blog")
 */

class PostController extends AbstractController
{

    /**
     * @Route("/post" , name="create_postblog", methods={"POST"})
     * @param Request $request
     */
     public function create(Request $request)
    {
        /**
         * @var Serializer $serializer
         */

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $data = $request->getContent();
        $post = $this->get('serializer')->deserialize($data, 'App\Entity\Post[]', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
       }

    /**
     * @param Request $request
     * @return json
     * @Route("/{page}", name="list_page", defaults={"page": 5}, requirements={"page"="/d+"})
     */
    public function list($page = 1, Request $request)
    {
        $limit = $request->get('limit',10);
        return $this->json(
            [
                "limit" => $limit,
                "page"  => $page,
                "data"  => array_map(function ($item){
                return $this->generateUrl("post", ["slug" => $item['slug']]);
                },
                self::POSTS)
            ]
        );
    }

    /**
     * @Route("/{slug}", name="post_by_slug")
     * @param Request $request
     */
    public function post(Post $post)
    {
        return $this->json($post);
    }

    /**
     * @Route("/{id}", requirements= {"id" = "\d+"}, name= "post_by_id")
     */
     public function getPost(Post $post)
     {
         return $this->json($post);
     }
}