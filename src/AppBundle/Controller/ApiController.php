<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends Controller{
    /**
     * @Route("home", name="api_home")
     */
    public function indexAction(SerializerInterface $serializer)
    {
        $entity = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findAll();

        $json = $serializer->serialize($entity,'json');

        return new JsonResponse($json, 200, [], true);
    }
}