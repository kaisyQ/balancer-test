<?php declare(strict_types=1);

namespace App\Application\Services;

use App\Application\Abstractions\Services\IMachineService;
use App\Application\Exceptions\ValidateException;
use App\Application\Models\MachineModel;
use App\Domain\Entities\Machine;
use App\Insfrastructure\Abstractions\Repositories\IMachineRepository;
use AutoMapper\AutoMapper;
use Doctrine\ORM\EntityManagerInterface;

final readonly class MachineService implements IMachineService
{
    public function __construct(
        private IMachineRepository $machineRepository,
        private EntityManagerInterface $em
    ) {}

    public function save(MachineModel $machineModel): void
    {
        $mapper = AutoMapper::create();

        /** @var Machine */
        $machineEntity = $mapper->map($machineModel, Machine::class);
        
        $this->em->persist($machineEntity);

        $this->em->flush();
    }

    public function deleteById(int $id): void
    {
        $process = $this->machineRepository->find($id);
    
        if ($process === null) {
            throw new ValidateException("Machine with id: $id not found");
        }

        $this->em->remove($process);

        $this->em->flush();
    }
}
