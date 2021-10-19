<?php

namespace App\Controller;

use App\Form\TableChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /**
     * @Route("/table", name="table")
     */

class TableController extends AbstractController
{
    /**
     * @Route("/select", name="table_select")
     */
    public function select(Request $request){
        
        $form = $this->createform(TableChoiceType::class);
        
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $data = $form->getData();
            $id = $data['id'];
            $nb = $data['nb_resultat'];
            $color = $data['color'];
            $response = $this->render('table/index.html.twig',[
                'controller_name' => 'TableController',
                'id' => $id,
                'nb_resultat' => $nb,
                'color' => $color,
            ]);
        }else{
            return $this->render('table/vue.html.twig', [ 
                'formulaire' => $form->createView(),
            ]);
        }
    }
    
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
