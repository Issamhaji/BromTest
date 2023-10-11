<?php

namespace App\Controller;

use App\Entity\Phase;
use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\PhaseRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends AbstractController
{

    #[Route('/', name: 'app_index')]
    public function index(Request $request, ProjectRepository $repository, PhaseRepository $phaseRepository): Response
    {
        $project = new Project();
        $phase = new Phase();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $repository->save($project,true);

            //create phase for project
            $phase->setProject($project);
            $phase->setValue(1);
            $phaseRepository->save($phase,true);


            return $this->redirectToRoute('app_deliverable', [ 'projectId' => $phase->getProject()->getId() , 'phase' => $phase->getId()]);

        }

        return $this->render('index/index.html.twig', [
            'form' => $form->createView(),
            'phase'=>$phase
        ]);
    }
    #[Route('/{id}', name: 'app_project')]
    public function project(int $id,Request $request,ProjectRepository $repository, PhaseRepository $phaseRepository): Response
    {
        $project = $repository->find($id);
        $form = $this->createForm(ProjectType::class, $project);
        $phase = $phaseRepository->findBy(['project'=>$id]);
        $lastPhase = end($phase);
        return $this->render('index/index.html.twig', [
            'form' => $form->createView(),
            'phase'=> $lastPhase
        ]);
    }



}
