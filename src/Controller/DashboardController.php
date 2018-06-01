<?php

namespace App\Controller;

use App\Repository\AppointmentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    /**
     * @Route("/dashboard/", name="dashboard")
     * @Security("has_role('ROLE_USER')")
     */
    public function index(AppointmentRepository $appointmentRepository)
    {
        return $this->render('dashboard/index.html.twig', [
            'allAppointments' => count($appointmentRepository->findAll()),
            'pendingAppointments' => $appointmentRepository->numberOfPendingAppointments(),
            'finishedAppointments' => $appointmentRepository->numberOfFinishedAppointments(),
            'activeAppointments' => $appointmentRepository->numberOfActiveAppointments(),
            'latestAppointments' => $appointmentRepository->getLatestAppointments()
        ]);
    }
}
