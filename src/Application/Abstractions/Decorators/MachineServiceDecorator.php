<?php declare(strict_types=1);

namespace App\Application\Abstractions\Decorators;

use App\Application\Abstractions\Services\IMachineService;
use App\Application\Models\MachineModel;

abstract class MachineServiceDecorator implements IMachineService
{

    public function __construct(
        private readonly IMachineService $machineService
    ) {}


    public function save(MachineModel $machineModel): void 
    {
        $this->machineService->save($machineModel);
    }

    public function deleteById(int $id): void
    {
        $this->machineService->deleteById($id);
    }
}