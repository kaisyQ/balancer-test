<?php declare(strict_types=1);

namespace App\Application\Abstractions\Decorators;

use App\Application\Abstractions\Services\IProcessService;
use App\Application\Models\ProcessModel;

abstract class ProcessServiceDecorator implements IProcessService
{

    public function __construct(
        private readonly IProcessService $processService
    ) {}


    public function save(ProcessModel $processModel): void 
    {
        $this->processService->save($processModel);
    }

    public function deleteById(int $id): void
    {
        $this->processService->deleteById($id);
    }
}