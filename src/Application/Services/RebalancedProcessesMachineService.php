<?php declare(strict_types=1);

namespace App\Application\Services;

use App\Application\Abstractions\Decorators\MachineServiceDecorator;
use App\Application\Abstractions\Services\IMachineService;
use App\Application\Abstractions\UseCases\IRebalanceProcessesUseCase;
use App\Application\Models\MachineModel;

final class RebalancedProcessesMachineService extends MachineServiceDecorator
{

    public function __construct(
        private readonly IRebalanceProcessesUseCase $rebalanceProcessesUseCase,
        private readonly IMachineService $machineService
    ){
        parent::__construct($machineService);
    }
    public function save(MachineModel $machineModel): void
    {
        parent::save($machineModel);
        
        $this->rebalanceProcessesUseCase->execute();
    }

    public function deleteById(int $id): void
    {
        parent::deleteById($id);

        $this->rebalanceProcessesUseCase->execute();
    }
}