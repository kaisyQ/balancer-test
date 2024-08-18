<?php declare(strict_types=1);

namespace App\Tests\Unit;

use App\Application\Exceptions\ValidateException;
use PHPUnit\Framework\TestCase;
use App\Application\Models\MachineModel;
use App\Domain\Entities\Machine;
use App\Application\Services\MachineService;
use App\Insfrastructure\Abstractions\Repositories\IMachineRepository;
use Doctrine\ORM\EntityManagerInterface;

class MachineServiceTest extends TestCase
{
    public function testSaveCreatesMachineEntityAndPersistsIt()
    {
        $machineModel = new MachineModel();
        $machineModel->setId(1);
        $machineModel->setTotalProcess(10);
        $machineModel->setTotalMemory(100);


        $machine = (new Machine())
            ->setId(1)
            ->setTotalMemory(100)
            ->setTotalProcess(10);

        /** @var EntityManagerInterface&\PHPUnit\Framework\MockObject\MockObject $entityManager */
        $entityManager = $this->createMock(EntityManagerInterface::class);
    
        /** @var IMachineRepository&\PHPUnit\Framework\MockObject\MockObject $machineRepository */
        $machineRepository = $this->createMock(IMachineRepository::class);
    
        $machineService = new MachineService($machineRepository, $entityManager);

        $entityManager->expects($this->once())
            ->method('persist')
            ->with($machine);

        $entityManager->expects($this->once())
            ->method('flush');

        $machineService->save($machineModel);
    }

    public function testDeleteByIdMachineNotFound(): void
    {
        // Arrange
        $id = 1;

        /** @var IMachineRepository&\PHPUnit\Framework\MockObject\MockObject $machineRepository */
        $machineRepository = $this->createMock(IMachineRepository::class);
        
        /** @var EntityManagerInterface&\PHPUnit\Framework\MockObject\MockObject $em */
        $em = $this->createMock(EntityManagerInterface::class);

        $machineRepository->method('find')->with($id)->willReturn(null);

        $this->expectException(ValidateException::class);
        $this->expectExceptionMessage("Machine with id: $id not found");

        $machineService = new MachineService($machineRepository, $em);

        $machineService->deleteById($id);
    }

    public function testDeleteByIdMachineFound(): void
    {
        $id = 1;

        $machine = (new Machine())
            ->setId($id)
            ->setTotalMemory(100)
            ->setTotalProcess(10)
        ;

        /** @var IMachineRepository&\PHPUnit\Framework\MockObject\MockObject $machineRepository */
        $machineRepository = $this->createMock(IMachineRepository::class);

        /** @var EntityManagerInterface&\PHPUnit\Framework\MockObject\MockObject $em */
        $em = $this->createMock(EntityManagerInterface::class);

        $machineService = new MachineService($machineRepository, $em);

        $machineRepository
        ->method('find')
        ->with($id)
        ->willReturn($machine);

        $em
            ->expects($this->once())
            ->method('remove')
            ->with($machine);
    
        $em
            ->expects($this->once())
            ->method('flush');

        $machineService->deleteById($id);
        
    }
}