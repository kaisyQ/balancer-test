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
use OpenApi\Attributes as OA;
#[Route(name: "process_controller", path: "/api/v1/processes")]
#[OA\Tag(name: "Processes")]
final class ProcessController extends AbstractController 
{
    public function __construct(
        private readonly ServicesIProcessService $processService,
    ){}
    #[Route(name: "@create", path: "", methods: ["POST"])]
    #[OA\Post(
        path: "/api/v1/processes", 
        description: "Метод добавляет новый процесс в общий пул", 
        summary: "Метод создания процесса",
        operationId: 'createProcess'
    )]
    #[OA\Response(response: 200, description: "OK")]
    public function createProcess(
        Request $request,
        #[MapRequestPayload()] CreateProcessRequest $data,
    ): Response 
    {
        /** @var ProcessModel */
        $processModel = AutoMapper::create()->map($data, ProcessModel::class);

        $this->processService->save($processModel);

        return new Response(status:200);
    }

    #[Route(name: "@delete", path: "/{id}", methods: ["DELETE"])]
    #[OA\Delete(
        path: "/api/v1/processes/{id}", 
        description: "Метод удаления процесса по его идентификатору", 
        summary: "Метод удаления процесса по его идентификатору",
        operationId: 'deleteProcess'
    )]
    #[OA\Parameter(in: "path", name: "id", description: "Идентификатор машины", example: 1)]
    #[OA\Response(response: 200, description: "OK")]
    public function deleteProcess(Request $request, int $id): Response 
    {
        $this->processService->deleteById($id);

        return new Response(status:200);
    }


}