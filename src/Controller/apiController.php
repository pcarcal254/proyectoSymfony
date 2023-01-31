<?php

namespace App\Controller;

use App\Entity\Mesa;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MesaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

#[Route(path: "/api", name: "api_")]
class apiController extends AbstractController
{

    //OBTENER TODAS LAS MESAS
    #[Route(path: "/mesa", name: "getMesa", methods: "GET")]
    public function getMesas(MesaRepository $mr): JsonResponse
    {
        $mesas = $mr->findAll();
        $data = [];

        foreach ($mesas as $mesa) {
            $data[] = [
                'id' => $mesa->getId(),
                'nombreMesa' => $mesa->getNomMesa(),
                'anchoMesa' => $mesa->getAnchoMesa(),
                'largoMesa' => $mesa->getLargoMesa(),
                'predPointMesa' => $mesa->getPredPoint(),
            ];
        };
        return $this->json($data);
    }

    //OBTENER UNA SOLA MESA
    #[Route(path: "/mesa/{idMesa}", name: "getMesaEspecifica", methods: "GET")]
    public function getMesa(int $idMesa = null, MesaRepository $mr): JsonResponse
    {
        if ($idMesa) {
            $mesa = $mr->find($idMesa);
            $data[] = [
                'id' => $mesa->getId(),
                'nombreMesa' => $mesa->getNomMesa(),
                'anchoMesa' => $mesa->getAnchoMesa(),
                'largoMesa' => $mesa->getLargoMesa(),
                'predPointMesa' => $mesa->getPredPoint(),
            ];
            return $this->json($data);
        }
    }

    //AÑADIR UNA NUEVA MESA
    #[Route(path: "/mesa", name: "nuevaMesa", methods: "POST")]
    public function nuevaMesa(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $mesa = new Mesa();
        $mesa->setNomMesa($request->request->get('nombreMesa'));
        $mesa->setAnchoMesa($request->request->get('anchoMesa'));
        $mesa->setLargoMesa($request->request->get('largoMesa'));
        $mesa->setPredPoint($request->request->get('predPointMesa'));

        $entityManager = $doctrine->getManager();
        $entityManager->persist($mesa);
        $entityManager->flush();
        return $this->json('Mesa creada correctamente con ID ' . $mesa->getId());
    }

    //ACTUALIZAR UNA MESA
    #[Route(path: "/mesa/{idMesa}", name: "updateMesa", methods: "PUT")]
    public function updateMesa(int $idMesa = null, ManagerRegistry $doctrine, MesaRepository $mr, Request $request): JsonResponse
    {
        if ($idMesa) {
            $mesa = $mr->find($idMesa);
            $mesa->setNomMesa($request->request->get('nombreMesa'));
            $mesa->setAnchoMesa($request->request->get('anchoMesa'));
            $mesa->setLargoMesa($request->request->get('largoMesa'));
            $mesa->setPredPoint($request->request->get('predPointMesa'));

            $entityManager = $doctrine->getManager();
            $entityManager->flush();

            $data[] = [
                'id' => $mesa->getId(),
                'nombreMesa' => $mesa->getNomMesa(),
                'anchoMesa' => $mesa->getAnchoMesa(),
                'largoMesa' => $mesa->getLargoMesa(),
                'predPointMesa' => $mesa->getPredPoint(),
            ];
            return $this->json($data);
        }

    }

    #[Route(path: "/mesa/{idMesa}", name: "updateMesa", methods: "DELETE")]
    public function deleteMesa(int $idMesa = null, ManagerRegistry $doctrine, MesaRepository $mr, Request $request): JsonResponse
    {
        if ($idMesa) {
            $mesa = $mr->find($idMesa);

            $entityManager = $doctrine->getManager();
            $entityManager->remove($mesa);
            $entityManager->flush();

            return $this->json('Mesa eliminida correctamente con ID ' . $idMesa);
        }
    }
}
