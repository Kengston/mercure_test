<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class PublicController extends AbstractController
{
    #[Route('/public', name: 'app_public')]
    public function index(): Response
    {
        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    #[Route('/public/publish', name: 'publish')]
    public function publish(HubInterface $hub, LoggerInterface $logger) : JsonResponse
    {
        $update = new Update(
            '/test',
            json_encode(['update' => 'New update received at '.date("h:i:sa")])
        );


        $hub->publish($update);
        return $this->json(['message' => 'Update published']);
    }
}
