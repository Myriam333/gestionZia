<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;



use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder) {
        $utilisateur = new Utilisateur();

        $form = $this -> createForm(InscriptionType::class, $utilisateur);

        $form -> handleRequest($request);

        if ($form -> isSubmitted() && $form -> isValid()) {

            $hash = $encoder -> encodePassword($utilisateur, $utilisateur -> getPassword());

            $utilisateur -> setPassword($hash);

            $manager -> persist($utilisateur);
            $manager -> flush();

            return $this -> redirectToRoute('connexion');
        }

        return $this -> render('security/inscription.html.twig', [
            'formInscription' => $form -> createView()
        ]);
    }
    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion() {

        return $this -> render('security/connexion.html.twig');
    }
    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion() {}
}
