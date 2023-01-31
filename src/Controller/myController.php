<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Entity\Categoria;
use App\Controller\ManagerRegistry;
use App\Repository\CategoriaRepository;
use App\Repository\MesaRepository;
use App\Repository\ProductoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class myController extends AbstractController {

    #[Route(path:"/",name:"Inicio")]
    public function landing():Response {
        return new Response("<h1>Se acabó</h1>");
    }

    #[Route(path:"/home",name:"Home")]
    public function home(): Response {

        $users = [
            ["id"=>"1","name"=>"Madalena"],
            ["id"=>"2","name"=>"Nert"],
            ["id"=>"3","name"=>"Chadd"],
            ["id"=>"4","name"=>"Woodrow"],
            ["id"=>"5","name"=>"Emelita"]
        ];
        if ($users) {
            $html = $this->render('homepage.html.twig', [
                'users' => $users,
            ]);
            return $html;
        }
    }

    #[Route(path:"/user/{user}",name:"User")]
    public function user(String $user = null, Request $request): Response {

        $id = $request->query->get('id');

        if ($user) {
            $html = $this->render('user.html.twig', [
                'user' => $user,
                'id' => $id
            ]);
            return $html;
        }
    }

    
    
}
