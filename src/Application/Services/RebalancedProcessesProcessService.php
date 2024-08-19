<?php declare(strict_types=1);

namespace App\Application\Services;

use App\Application\Abstractions\Decorators\ProcessServiceDecorator;
use App\Application\Abstractions\Services\IProcessService;
use App\Application\Abstractions\UseCases\IRebalanceProcessesUseCase;
use App\Application\Models\ProcessModel;

final class RebalancedProcessesProcessService extends ProcessServiceDecorator
{

    public function __construct(
        private readonly IRebalanceProcessesUseCase $rebalanceProcessesUseCase,
        private readonly IProcessService $processService
    ){
        parent::__construct($processService);
    }
    public function save(ProcessModel $processModel): void
    {
        parent::save($processModel);
        
        $this->rebalanceProcessesUseCase->execute();
    }

    public function deleteById(int $id): void
    {
        parent::deleteById($id);

        $this->rebalanceProcessesUseCase->execute();
    }
}