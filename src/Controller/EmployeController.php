<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Employe;
use App\Form\EmployeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api",name="_api")
 */
class EmployeController extends FOSRestController
{
    /**
     * @Rest\Get("/employes")
     */
    public function index()
    {
        $repo=$this->getDoctrine()->getRepository(Employe::class);
        $employes=$repo->findAll();
        return $this->handleView($this->view($employes));
    }
    /**
     * @Rest\Post("/employe")
     */
    public function ajout(Request $request)
    {
        $employe = new Employe();
        $form=$this->createForm(EmployeType::class,$employe);
        $data=json_decode($request->getContent(),true);
        $form->submit($data);
        
        if($form->isSubmitted() && $form->isValid()){
            var_dump($data);
            $em=$this->getDoctrine()->getManager();
            $em->persist($employe);
            $em->flush();
            return $this->handleView($this->view(['status'=>'ok'],Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));

        
    }

}
