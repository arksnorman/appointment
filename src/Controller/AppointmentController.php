<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Form\AppointmentType;
use App\Repository\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Route("/appointment")
 * @Security("has_role('ROLE_USER')")
 */
class AppointmentController extends Controller
{
    /**
     * @Route("/", name="appointment_index", methods="GET")
     */
    public function index(): Response
    {
        return $this->render('appointment/index.html.twig', []);
    }

    /**
     * @Route("/new", name="appointment_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $appointment = new Appointment();
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $appointment->setDateCreated();
            $appointment->setStatus('pending');
            $appointment->setUser($this->getUser());
            $em->persist($appointment);
            $em->flush();
            $this->addFlash('success', 'Appointment created successfully');
            return $this->redirectToRoute('my_appointments');
        }

        return $this->render('appointment/new.html.twig', [
            'appointment' => $appointment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="appointment_show", methods="GET")
     */
    public function show(Appointment $appointment): Response
    {
        return $this->render('appointment/show.html.twig', ['appointment' => $appointment]);
    }

    /**
     * @Route("/{id}/edit/", name="appointment_edit", methods="GET|POST")
     */
    public function edit(Request $request, Appointment $appointment): Response
    {
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Appointment updated successfully');
            return $this->redirectToRoute('appointment_edit', ['id' => $appointment->getId()]);
        }

        return $this->render('appointment/edit.html.twig', [
            'appointment' => $appointment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/my/appointments/", name="my_appointments")
     */
    public function myAppointments(): Response
    {
        $appointments = $this->getUser()->getAppointments();
        return $this->render('appointment/my_appointments.html.twig', [
            'appointments' => $appointments,
        ]);
    }

    /**
     * @Route("/{id}/delete/", name="appointment_delete")
     */
    public function delete(Appointment $appointment): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($appointment);
        $em->flush();
        $this->addFlash('success', 'Appointment deleted successfully');
        return $this->redirectToRoute('appointment_index');
    }
}
