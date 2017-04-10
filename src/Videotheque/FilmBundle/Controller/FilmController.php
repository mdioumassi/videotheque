<?php

namespace Videotheque\FilmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Videotheque\FilmBundle\Entity\Film;
use Videotheque\FilmBundle\Form\FilmType;
use Videotheque\FilmBundle\Repository;

class FilmController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listeFilm = $em->getRepository('VideothequeFilmBundle:Film')->findAll();
        
        if(null === $listeFilm){
            throw new NotFoundHttpException("Film non trouvé");
        }
        return $this->render('VideothequeFilmBundle:Film:index.html.twig', array(
            'films'=>$listeFilm,
        ));
    }

    public function ajoutAction(Request $request)
    {
        $film = new Film();
        $form =  $this->createForm(FilmType::class, $film);
        
        if($request->isMethod('POST')){
            $form -> handleRequest($request);
            
            if($form->isValid()){
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($film);
                $em->flush();
                
                $request->getSession()->getFlashBag()->add('notice', 'Film bien enregistré');
                return $this->redirectToRoute('film_home');
            }
        }
        
        return $this->render('VideothequeFilmBundle:Film:ajout.html.twig', array(
           'form' => $form->createView(),
        ));
    }

    public function modifierAction()
    {
        return $this->render('VideothequeFilmBundle:Film:modifier.html.twig', array(
            // ...
        ));
    }

    public function supprimerAction($id)
    {
        $film = $this->getEM()->getRepository('VideothequeFilmBundle:Film')->find($id);
        return $this->render('VideothequeFilmBundle:Film:supprimer.html.twig', array(
            'film'=>$film->getTitre(),
            'id' =>$id
        ));
    }

    public function detailAction()
    {
        return $this->render('VideothequeFilmBundle:Film:detail.html.twig', array(
            // ...
        ));
    }
    
    public function rechercheAction()
    {
        return $this->render('VideothequeFilmBundle:Film:recherche.html.twig', array(
            // ...
        ));
    }

    private function getEM(){
        return $this->getDoctrine()->getManager();
    }

}
