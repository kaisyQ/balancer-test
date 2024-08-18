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
#[Route(name: "machine_controller", path: "/api/v1/machines")]
final class MachineController extends AbstractController 
{
    public function __construct(
        private readonly IMachineService $machineService,
    ){}

    #[Route(name: "@create", path: "", methods: ["POST"])]
    public function createMachine(Request $request, #[MapRequestPayload] CreateMachineRequest $data): Response 
    {

        $mapper = AutoMapper::create();

        /** @var MachineModel */
        $machineModel = $mapper->map($data, MachineModel::class);

        $this->machineService->save($machineModel);

        return new Response(status: 200);
    }
    #[Route(name: "@delete", path: "/{id}", methods: ["DELETE"])]
    public function deleteMachine(Request $request, int $id): Response 
    {

        $this->machineService->deleteById($id);

        return new Response(status:200);
    }

}

