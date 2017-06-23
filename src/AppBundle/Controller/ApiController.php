<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends Controller{
    /**
     * @Route("home", name="api_home")
     */
    public function indexAction(SerializerInterface $serializer)
    {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();

        $json = $serializer->serialize($users,'json');

        return new JsonResponse($json, 200, [], true);
    }

    /**
     * @Route("foo", name="api_foo")
     */
    public function fooAction(SerializerInterface $serializer)
    {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();

        $json = $serializer->serialize($users,'json');

        return new JsonResponse(['users' => json_decode($json)]);
    }

    /**
     * @Route("bar", name="api_bar")
     */
    public function barAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();

        $normalizer = new ObjectNormalizer();

        $iterator = function (User $user) use ($normalizer) {
            return $normalizer->normalize($user);
        };

        $users = \array_map($iterator, $users);

        return new JsonResponse(['users' => $users]);
    }
}