<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Form\AbsenceType;
use App\Entity\Salarie;
use App\Form\SalarieType;

use App\Repository\SalarieRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function welcome() {
        return $this -> render('app/welcome.html.twig', [
            'controller_name' => 'AppController'
            ]);
    }
    /**
     * @Route("/home", name="home")
     */
    public function home(SalarieRepository $repo) {
        $salaries = $repo -> findAll();

        return $this -> render('app/home.html.twig', [
            'controller_name' => 'AppController',
            'salaries' => $salaries
        ]);
    }
    /**
     * @Route("/home/delete/salarie/{id}", name="supprimer")
     */
    public function delete($id) {

        $em = $this -> getDoctrine() -> getManager();

        $obj = $em -> getRepository('App\Entity\Salarie') -> find($id);
        $em -> remove($obj);
        $em -> flush();

        return $this -> redirectToRoute('home');
    }
    /**
     * @Route("/home/salarie/new", name="create")
     * @Route("/home/salarie/{id}/edit", name="edit")
     */
    public function formS(Salarie $salarie = null, Request $request, ObjectManager $manager) {
        if (!$salarie) {
            $salarie = new Salarie();
        }

        $form = $this ->createForm(SalarieType::class, $salarie);

        $form ->handleRequest($request);

        if ($form ->isSubmitted() && $form ->isValid()) {

            $manager ->persist($salarie);

            $manager ->flush();
            return $this ->redirectToRoute('fiche', ['id' => $salarie ->getId()]);
        }

        return $this ->render('app/create.html.twig', [
            'formSalarie' => $form ->createView(),
            'editMode' => $salarie ->getId() !== null
        ]);

    }

    /**
     * @Route("/home/fiche/salarie{id}", name="fiche")
     */
    public function fiche(Salarie $salarie, Request $request, ObjectManager $manager) {
        $absence = new Absence();

        $form = $this -> createForm(AbsenceType::class, $absence);

        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) {
            $absence -> setSalarie($salarie);

            $manager -> persist($absence);
            $manager -> flush();

            return $this -> redirectToRoute('fiche', ['id' => $salarie -> getId()]);
        }

        return $this -> render('app/fiche.html.twig', [
            'salarie' => $salarie,
            'absenceForm' => $form -> createView()
        ]);
    }

}
