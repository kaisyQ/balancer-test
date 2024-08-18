<?php declare(strict_types=1);


namespace App\Presentation\Controllers;

use App\Application\Abstractions\Services\IProcessService as ServicesIProcessService;
use App\Application\Models\ProcessModel;
use App\Presentation\Requests\CreateProcessRequest;
use AutoMapper\AutoMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(name: "process_controller", path: "/api/v1/processes")]
final class ProcessController extends AbstractController 
{
    public function __construct(
        private readonly ServicesIProcessService $processService,
    ){}
    #[Route(name: "@create", path: "", methods: ["POST"])]
    public function createProcess(
        Request $request,
        #[MapRequestPayload()] CreateProcessRequest $data,
    ): Response 
    {
        $mapper = AutoMapper::create();

        /** @var ProcessModel */
        $processModel = $mapper->map($data, ProcessModel::class);

        $this->processService->save($processModel);

        return new Response(status:200);
    }

    #[Route(name: "@delete", path: "/{id}", methods: ["DELETE"])]
    public function deleteProcess(Request $request, int $id): Response 
    {
        $this->processService->deleteById($id);

        return new Response(status:200);
    }


}