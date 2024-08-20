<?php declare(strict_types=1);

namespace App\Tests\Unit;

use App\Application\Exceptions\ValidateException;
use PHPUnit\Framework\TestCase;
use App\Application\Models\MachineModel;
use App\Domain\Entities\Machine;
use App\Application\Services\MachineService;
use App\Insfrastructure\Abstractions\Repositories\IMachineRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;

class MachineServiceTest extends TestCase
{


    public static function provideTestCreateMachine(): array {
        return [
            'Характеристики рабочей машины' => [
                'id' => 1,
                'totalProcess' => 10,
                'totalMemory' => 100
            ]
        ];
    }

    #[DataProvider('provideTestCreateMachine')]
    #[TestDox('Тест создания машины')]
    public function testCreateMachine(int $id, int $totalProcess, int $totalMemory)
    {
        $machineModel = new MachineModel();
        $machineModel->setId($id);
        $machineModel->setTotalProcess($totalProcess);
        $machineModel->setTotalMemory($totalMemory);


        $machine = (new Machine())
            ->setId($id)
            ->setTotalMemory($totalMemory)
            ->setTotalProcess($totalProcess);

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

    public static function provideTestDeleteMachineByIdNotFound(): array {
        return [
            'Несуществующий идентификатор машины' => [
                'id' => 1
            ]
        ];
    }

    #[DataProvider('provideTestDeleteMachineByIdNotFound')]
    #[TestDox('Тест удаления машины, если машина не существует')]
    public function testDeleteByIdMachineNotFound(int $id): void
    {
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

    public static function provideTestDeleteMachineByIdFound(): array {
        return [
            'Характеристрики существующей машины' => [
                'id' => 1,
                'totalProcess' => 10,
                'totalMemory' => 100
            ]
        ];
    }
    #[DataProvider('provideTestDeleteMachineByIdFound')]
    #[TestDox('Тест удаления машины, если машина существует')]
    public function testDeleteByIdMachineFound(int $id, int $totalProcess, int $totalMemory): void
    {
        $machine = (new Machine())
            ->setId($id)
            ->setTotalMemory($totalMemory)
            ->setTotalProcess($totalProcess)
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