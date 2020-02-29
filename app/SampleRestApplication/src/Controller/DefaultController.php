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
use App\Entity\Employee;
use App\Model\EmployeeResponse;
use App\Model\EmployeeRequest;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/employees")
 */
class DefaultController extends FOSRestController
{

    // TODO: Post file
    // TODO: Get file
    // TODO: Basic auth
    // TODO: Token

   /**
     * @Get("")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of employee responses",
     *     @Model(type=EmployeeResponse::class)
     * )
     * 
   	 * @param ParamFetcherInterface $paramFetcher
     */
    public function listAction(ParamFetcherInterface $paramFetcher)
    {
        $employees = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findAll();

        $records = [];

        foreach ($employees as $employee) {
            $employeeResponse = new EmployeeResponse();
            $employeeResponse->name =$employee->getName();
            $employeeResponse->age = $employee->getAge();
            $employeeResponse->salary = $employee->getSalary();
            $employeeResponse->uuid = $employee->getUuid();

            $records[] = $employeeResponse;
        }

    	$response = new Response(json_encode($records));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Get("/{uuid}")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns a specific employee record",
     *     @Model(type=EmployeeResponse::class)
     * )
     */
    public function detailAction(string $uuid)
    {
        $employee = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findOneByUuid($uuid);

        if ($employee === null) {
            throw new EntityNotFoundException(sprintf("No employee found with uuid %s", $uuid));
        }
        
        $employeeResponse = new EmployeeResponse();
        $employeeResponse->name =$employee->getName();
        $employeeResponse->age = $employee->getAge();
        $employeeResponse->salary = $employee->getSalary();
        $employeeResponse->uuid = $employee->getUuid();

        $response = new Response(json_encode($employeeResponse));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Post("")
     *
     * @ParamConverter(
     *     "employeeRequest",
     *     converter="fos_rest.request_body"
     * )
     */
    public function createAction(EmployeeRequest $employeeRequest)
    {
        // TODO: Handle errors (ConstraintViolationListInterface $validationErrors)

        $response = new Response();

        try {
            $employeeEntity = new Employee();
            $employeeEntity->setName($employeeRequest->name);
            $employeeEntity->setAge($employeeRequest->age);
            $employeeEntity->setSalary($employeeRequest->salary);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employeeEntity);
            $entityManager->flush();
            
            $response->setStatusCode(201);
            $response->headers->set('location', sprintf('employees/%s', $employeeEntity->getUuid()));
        } catch (\Exception $e) {
            die('ERROR'); // TODO: Fix
        }

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