<?php

namespace Videotheque\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('VideothequeCoreBundle:Core:index.html.twig');
    }
}
