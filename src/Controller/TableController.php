<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/table", name="table")
     */

class TableController extends AbstractController
{
    
    public function index(): Response
    {
        return $this->render('table/index.html.twig', [
            'controller_name' => 'TableController',
        ]);
    }

    /**
     * @Route("/multi/{id}/{nb}", name="multi")
     */
    
    public function TableMulti(int $id, int $nb, Request $request): Response
    {
        $color = $request->get('c'); //pour alléger symphony en requêtes
        
        if (empty($color)){
            $color='black';
        } 
       
        return $this->render('table/index.html.twig',[
            'controller_name' => 'TableController',
            'id' => $id,
            'nb_resultat' => $nb,
            'color' => $color,
        ]);
        
    }
}
