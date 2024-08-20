<?php declare(strict_types=1);

namespace App\Presentation\Controllers;

use App\Application\Abstractions\Services\IMachineService;
use App\Application\Models\MachineModel;
use App\Presentation\Requests\CreateMachineRequest;
use AutoMapper\AutoMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
#[Route(name: "machine_controller", path: "/api/v1/machines")]
#[OA\Tag(name: "Machines")]
final class MachineController extends AbstractController 
{
    public function __construct(
        private readonly IMachineService $machineService,
    ){}

    #[Route(name: "@create", path: "", methods: ["POST"])]
    #[OA\Post(
        path: "/api/v1/machines", 
        description: "Метод добаляется новую рабочую машину в пул", 
        summary: "Метод добавления рабочей машины",
        operationId: 'createMachine'
    )]
    #[OA\Response(response: 200, description: "OK")]
    public function createMachine(Request $request, #[MapRequestPayload] CreateMachineRequest $data): Response 
    {
        /** @var MachineModel */
        $machineModel = AutoMapper::create()->map($data, MachineModel::class);

        $this->machineService->save($machineModel);

        return new Response(status: 200);
    }

    #[Route(name: "@delete", path: "/{id}", methods: ["DELETE"])]
    #[OA\Parameter(in: "path", name: "id", description: "Идентификатор машины", example: 1)]
    #[OA\Delete(
        path: "/api/v1/machines/{id}", 
        description: "Метод удаляет рабочую машину по её идентификатору", 
        summary: "Метод удаления рабочей машины",
        operationId: 'deleteMachine'
    )]
    #[OA\Response(response: 200, description: "OK")]
    public function deleteMachine(Request $request, int $id): Response 
    {
        $this->machineService->deleteById($id);

        return new Response(status:200);
    }

}

