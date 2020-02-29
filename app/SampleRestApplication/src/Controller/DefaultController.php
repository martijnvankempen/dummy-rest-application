<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\Reward;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * @Route("/employees")
 */
class DefaultController extends FOSRestController
{
    public function index()
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }

   /**
     * @Get("")
     * 
   	 * @param ParamFetcherInterface $paramFetcher
     */
    public function listAction(ParamFetcherInterface $paramFetcher)
    {
    	$data = [];

    	$data['message'] = "Hello world";

    	$response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Post("")
     */
    public function createAction()
    {
    	$data = [];

    	$data['message'] = "Hello world " . $uuid;

    	$response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Put("/{uuid}")
     */
    public function updateAction(string $uuid)
    {
    	$data = [];

    	$data['message'] = "Hello world " . $uuid;

    	$response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /**
     * @Delete("/{uuid}")
     */
    public function deleteAction(string $uuid)
    {
    	$data = [];

    	$data['message'] = "Hello world " . $uuid;

    	$response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


}