<?php

namespace Videotheque\FilmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VideothequeFilmBundle:Default:index.html.twig');
    }
}
