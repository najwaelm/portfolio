<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('ROLE_USER')]
class ProjectController extends AbstractController
{
    # READ ALL
    #[Route('/project', name: 'index_projects')]
    public function index(ProjectRepository $projectRepository ): Response
    {
        $projects= $projectRepository->findAll();
        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    # CREATE
    #[Route("/new", name: "new_project")]
    public function new_project( Request $request, EntityManagerInterface $em){

        $data=[];
        $project = new Project();
        $form= $this->createForm(ProjectType::class, $project); // créer le formulaire pour nous!

        $data["form"]= $form;

        $form->handleRequest(($request));

        if($form->isSubmitted()&& $form->isValid()){
            $em->persist($project); // si id=== null => InSERT id=== 1 => UPDATE
            $em->flush(); 
            return $this->redirectToRoute("index_projects"); 
        }; 

        return $this->render("project/new_project.html.twig",$data);
    }

    # UPDATE
    #[Route("/update/{id}", name: "update_project")]
     public function update(int $id,
      ProjectRepository $ProjetsRepository,
       Request $request,  
        EntityManagerInterface $em){ 
         	$projet = $ProjetsRepository->findOneBy(["id"=>$id]);
             $form=$this->createForm(ProjectType::class, $projet,["label"=>"modifier"]);

             $form->handleRequest($request);
             if($form->isSubmitted()&&$form->isValid()){
                 $em->persist($projet); 
                 $em->flush(); 
                 return $this->redirectToRoute("index_projects");
             }

             return $this->render("project/update_project.html.twig",["form"=> $form]);
    }

    # DELETE

    #[Route("/delete/{id}", name: "delete_project")]
    public function delete(
            EntityManagerInterface $em,
            ProjectRepository $ProjetsRepository,
            int $id,
        ){
        $projet = $ProjetsRepository->FindOneBy(["id"=>$id]);
        $em->remove($projet);
        $em->flush();
        return $this->redirectToRoute("index_projects");
     }
}
