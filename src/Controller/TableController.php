<?php

namespace App\Controller;

use App\Entity\Table;
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
            //dump("submit");
            $data = $form->getData();
            $id = $data['id'];
            $nb = $data['nb_resultat'];
            $color = $data['color'];

            $table = new Table($id);
            $calculations = $table->calcMultiply($nb);
            //dump($nb);
            $response = $this->render('table/index.html.twig',[
                'controller_name' => 'TableController',
                'id' => $id,
                'calculations' => $calculations,
                'color' => $color,
                
            ]);
        }else{
            //dump("not submit");
            $response = $this->render('table/vue.html.twig', [ 
                'formulaire' => $form->createView(),
            ]);
        }

        return $response;
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