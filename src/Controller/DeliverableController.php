<?php

namespace App\Controller;

use App\Entity\Deliverables;
use App\Entity\Phase;
use App\Form\DeliverableType;
use App\Repository\DeliverablesRepository;
use App\Repository\PhaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class DeliverableController extends AbstractController
{
    #[Route('/deliverable/{projectId}/{phase}', name: 'app_deliverable')]
    public function index(int $projectId, int $phase, Request $request, DeliverablesRepository $repository, PhaseRepository $phaseRepository): Response
    {
        $currentPhase = $phaseRepository->findBy(['id'=> $phase]);
        $nextPhaseValue = $currentPhase[0]->getValue() + 1;
        $currentDeliverable = $repository->findBy(['phase'=> $currentPhase[0]->getId()]);
//        dd($currentDeliverable !== []);
//        dd($currentPhase[0]->getValue());
        // Check if the current phase value is 6, and if so, redirect to app_index
        if ($currentPhase[0]->getValue() === 7 && $currentDeliverable === []) {

            $deliverable = new Deliverables();
            $form = $this->createForm(DeliverableType::class, $deliverable);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $deliverable->setPhase($currentPhase[0]);
                $repository->save($deliverable, true);
            }
            return $this->redirectToRoute('app_list',['projectId' => $projectId]);
        }else if($currentPhase[0]->getValue() === 6 && $currentDeliverable !== []){
            return $this->redirectToRoute('app_list',['projectId' => $projectId]);
        }


        $request->getSession()->set('phase', $currentPhase[0]->getId());

        //create next phase for project
        $newPhase = new Phase();
        $newPhase->setProject($currentPhase[0]->getProject());
        $newPhase->setValue($nextPhaseValue);
        $phaseRepository->save($newPhase);

        $deliverable = new Deliverables();
        $form = $this->createForm(DeliverableType::class, $deliverable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $deliverable->setPhase($currentPhase[0]);

            $repository->save($deliverable, true);

//            $request->getSession()->set('phase', $newPhase->getId());

            return $this->redirectToRoute('app_deliverable',['projectId' => $projectId , 'phase' => $newPhase->getId()]);

        }

        return $this->render('deliverable/index.html.twig', [
            'form' => $form->createView(),
            'phase'=> $currentPhase

        ]);
    }

    #[Route('/list/{projectId}', name: 'app_list')]
    public function list(int $projectId, DeliverablesRepository $repository,PhaseRepository $phaseRepository):Response
    {
        $currentPhase = $phaseRepository->findBy(['project'=> $projectId]);
        // Collect the phase IDs
        $phaseIds = [];
        foreach ($currentPhase as $phase) {
            $phaseIds[] = $phase->getId();
        }
        $deliverables = $repository->findBy(['phase' => $phaseIds]);
        $lastphase = end($currentPhase);
        return $this->render('deliverable/list.html.twig', [
            'deliverables' => $deliverables,
            'phase' => $lastphase
        ]);
    }

    #[Route('/download/{id}', name: 'download_deliverable')]
    public function downloadDeliverable(int $id, Request $request, DeliverablesRepository $repository): Response
    {
        $deliverable = $repository->find($id);

        // Ensure that the deliverable exists
        if (!$deliverable) {
            throw $this->createNotFoundException('Deliverable not found');
        }

        // Determine which file to download based on the 'file' query parameter
        $fileParam = $request->query->get('file');
        if ($fileParam === 'deliverable2') {
            $fileName = $deliverable->getDeliverable2Name();
        } else {
            $fileName = $deliverable->getDeliverable1Name();
        }

        // Construct the file path
        $deliverablesDirectory = $this->getParameter('app.path.deriverable_files');
        $filePath = $deliverablesDirectory . '/' . $fileName;
        $absoluteFilePath = $this->getParameter('kernel.project_dir') . '/public' . $deliverablesDirectory . '/' . $fileName;
        // Create a BinaryFileResponse to send the file
        $response = new BinaryFileResponse($absoluteFilePath);

        // Set the response headers
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $fileName);

        return $response;
    }

    public function links(PhaseRepository $repository,Request $request): Response
    {
        $id = $request->getSession()->get('phase');
        if($id ){
            $phase = $repository->find($id);
        }else{
            $phase = null;
        }

        return $this->render('partials/_links_layout.html.twig', [
            'item'=> $phase
        ]);
    }

}
