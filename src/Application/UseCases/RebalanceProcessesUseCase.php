<?php declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\Abstractions\UseCases\IRebalanceProcessesUseCase;
use App\Application\Exceptions\ValidateException;
use App\Application\Models\MachineModel;
use App\Application\Models\ProcessModel;
use App\Domain\Entities\Machine;
use App\Domain\Entities\Process;
use App\Infrastructure\Abstractions\Repositories\IMachineRepository;
use App\Infrastructure\Abstractions\Repositories\IProcessRepository;
use AutoMapper\AutoMapper;
use Doctrine\ORM\EntityManagerInterface;

final readonly class RebalanceProcessesUseCase implements IRebalanceProcessesUseCase
{
    public function __construct(
        private IProcessRepository $processRepository,
        private IMachineRepository $machineRepository,
        private EntityManagerInterface $em,
    ){}
    public function execute(): void
    {
        /** @var Machine[] $machines */
        $machines = $this->machineRepository->findAll();

        if (count($machines) === 0) {
            throw new ValidateException("No machines for balancing processes");
        }

        $processes = $this->processRepository->findAll();

        if (count($processes) === 0) {
            return;
        }

        $mapper = AutoMapper::create();

        /** @var MachineModel[] $machineModels */
        $machineModels = array_map(static fn (Machine $machine) => $mapper->map($machine, MachineModel::class), $machines);

        /** @var ProcessModel[] $processModels */
        $processModels = array_map(static fn (Process $process) => $mapper->map($process, ProcessModel::class), $processes);

        usort (
            $machineModels, 
            static fn (MachineModel $first, MachineModel $second) => 
                $first->getTotalMemory() + $first->getTotalProcess() <=> 
                $second->getTotalMemory() + $second->getTotalProcess()
        );
        
        foreach ($processModels as $processModel) {
            
            foreach ($machineModels as $machineModel) {

                if (!(
                        $machineModel->getTotalMemory() - $machineModel->getLoadedMemory() >= $processModel->getTotalMemory() && 
                        $machineModel->getTotalProcess() - $machineModel->getLoadedProcess() >= $processModel->getTotalProcess()
                    )
                ) {
                    continue;
                }

                $machineModel->setLoadedMemory($machineModel->getLoadedMemory() + $processModel->getTotalMemory());

                $machineModel->setLoadedProcess($machineModel->getLoadedProcess() + $processModel->getTotalProcess());

                $processModel->setMachineId($machineModel->getId());
                
                usort($machineModels, static fn (MachineModel $first, MachineModel $second) => $first->getTotalLoad() <=> $second->getTotalLoad());

                break;
            }
        }

        $resultedProcesses = array_combine(array_map(static fn (ProcessModel $model) => $model->getId(), $processModels), $processModels);
        
        foreach($processes as $process) {
            $process->setMachineId($resultedProcesses[$process->getId()]->getMachineId());
            
            $this->em->persist($process);
        }

        $this->em->flush();
    }
}
