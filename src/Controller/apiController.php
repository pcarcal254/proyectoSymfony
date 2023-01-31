<?php

namespace App\Controller;

use App\Entity\Mesa;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MesaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $response = new JsonResponse();
        $response->setContent(json_encode(array(
            'success' => true,
            'data' => $data,
        )));
        return $response;
    }

    //OBTENER UNA SOLA MESA
    #[Route(path: "/mesa/{idMesa}", name: "getMesaEspecifica", methods: "GET")]
    public function getMesa(int $idMesa = null, MesaRepository $mr): JsonResponse
    {
        if ($idMesa) {
            $mesa = $mr->find($idMesa);
            if ($mesa != null) {
                $data[] = [
                    'id' => $mesa->getId(),
                    'nombreMesa' => $mesa->getNomMesa(),
                    'anchoMesa' => $mesa->getAnchoMesa(),
                    'largoMesa' => $mesa->getLargoMesa(),
                    'predPointMesa' => $mesa->getPredPoint(),
                ];
                $response = new JsonResponse();
                $response->setContent(json_encode(array(
                    'success' => true,
                    'data' => $data,
                )));
                return $response;
            } else {
                $response = new JsonResponse();
                $response->setContent(json_encode(array(
                    'success' => false,
                    'data' => 'No existe mesa con la ID introducida',
                )));
                return $response;
            }
        } else {
            $response = new JsonResponse();
            $response->setContent(json_encode(array(
                'success' => false,
                'data' => "",
            )));
            return $response;
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

        $response = new JsonResponse();
        $response->setContent(json_encode(array(
            'success' => true,
            'data' => 'Mesa creada correctamente con ID'. $mesa->getId(),
        )));
        return $response;

    }

    //ACTUALIZAR UNA MESA
    #[Route(path: "/mesa/{idMesa}", name: "updateMesa", methods: "PUT")]
    public function updateMesa(int $idMesa = null, ManagerRegistry $doctrine, MesaRepository $mr, Request $request): JsonResponse
    {
        if ($idMesa) {
            $mesa = $mr->find($idMesa);
            if ($mesa != null) {
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

                $response = new JsonResponse();
                $response->setContent(json_encode(array(
                    'success' => true,
                    'data' => $this->json($data),
                )));
                return $response;
            } else {
                $response = new JsonResponse();
                $response->setContent(json_encode(array(
                    'success' => false,
                    'data' => 'No existe mesa con la ID introducida',
                )));
                return $response;
            }
            
        } else {
            $response = new JsonResponse();
            $response->setContent(json_encode(array(
                'success' => false,
                'data' => $this->json('No se ha encontrado la mesa en nuestra base de datos'),
            )));
            return $response;
        }

    }

    #[Route(path: "/mesa/{idMesa}", name: "updateMesa", methods: "DELETE")]
    public function deleteMesa(int $idMesa = null, ManagerRegistry $doctrine, MesaRepository $mr, Request $request): JsonResponse
    {
        if ($idMesa) {
            $mesa = $mr->find($idMesa);

            if ($mesa != null) {
                $entityManager = $doctrine->getManager();
                $entityManager->remove($mesa);
                $entityManager->flush();

                $response = new JsonResponse();
                $response->setContent(json_encode(array(
                    'success' => true,
                    'data' => 'Mesa eliminida correctamente con ID ' . $idMesa,
                )));
                return $response;
            } else {
                $response = new JsonResponse();
                $response->setContent(json_encode(array(
                    'success' => false,
                    'data' => 'No existe mesa con la ID introducida',
                )));
                return $response;
            }
        } else {
            $response = new JsonResponse();
            $response->setContent(json_encode(array(
                'success' => false,
                'data' => 'No has introducido una ID para eliminar la mesa',
            )));
            return $response;
        }
    }
}
