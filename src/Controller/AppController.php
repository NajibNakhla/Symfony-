<?php

namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FORM_NAME;
use App\Entity\ENTITY_NAME;
use App\Repository\REPOSITORY_NAME;
use Symfony\Component\Form\FormTypeInterface;


use App\Entity\APPLIANCE;
use App\Form\AddFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/app', name: 'app_app')]
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }


    #[Route('/list', name: 'app_list')]
    public function listAppliances(): Response
    {
        // Fetch the list of appliances from the database
        $appliances = $this->getDoctrine()->getRepository(APPLIANCE::class)->findAll();
    
        // Render the template with the list of appliances
        return $this->render('app/list.html.twig', [
            'appliances' => $appliances,
        ]);
    }
 // Add methods for adding, updating, and deleting appliances as needed

 #[Route('/add', name: 'appliance_add')]
 public function addAppliance(Request $request): Response
 {
     $appliance = new APPLIANCE(); // Update with your entity class
     $form = $this->createForm(AddFormType::class, $appliance); // Use AddFormType

     $form->handleRequest($request);

     if ($form->isSubmitted() && $form->isValid()) {
         $entityManager = $this->getDoctrine()->getManager();
         $entityManager->persist($appliance);
         $entityManager->flush();

         return $this->redirectToRoute('app_list'); // Redirect to the list of appliances
     }

     return $this->render('app/add.html.twig', [
         'form' => $form->createView(),
     ]);
 }
}
