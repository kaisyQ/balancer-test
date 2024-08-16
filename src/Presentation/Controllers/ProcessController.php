<?php declare(strict_types=1);


namespace App\Presentation\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(name: "process_controller", path: "/api/v1/process")]
final class ProcessController extends AbstractController 
{
    public function __construct()
    {
    }
    #[Route(name: "create", path: "", methods: ["POST"])]
    public function createProcess(Request $request): Response 
    {
        return new Response(status:200);
    }

    #[Route(name: "delete", path: "", methods: ["DELETE"])]
    public function deleteProcess(Request $request): Response 
    {
        return new Response(status:200);
    }


}