<?php declare(strict_types=1);

namespace App\Tests\Unit;

use App\Application\Exceptions\ValidateException;
use PHPUnit\Framework\TestCase;
use App\Application\Models\ProcessModel;
use App\Application\Services\ProcessService;
use App\Domain\Entities\Process;
use App\Infrastructure\Abstractions\Repositories\IProcessRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;

class ProcessServiceTest extends TestCase
{


    public static function provideTestCreateProcess(): array {
        return [
            'Характеристики нового процесса' => [
                'id' => 1,
                'totalProcess' => 10,
                'totalMemory' => 100,
                'machineId' => null
            ]
        ];
    }

    #[DataProvider('provideTestCreateProcess')]
    #[TestDox('Тест создания нового процессв')]
    public function testCreateProcess(int $id, int $totalProcess, int $totalMemory, ?int $machineId): void
    {
        $processModel = (new ProcessModel())
            ->setId($id)
            ->setTotalProcess($totalProcess)
            ->setTotalMemory($totalMemory)
            ->setMachineId($machineId)
        ;


        $process = (new Process())
            ->setId($id)
            ->setTotalMemory($totalMemory)
            ->setTotalProcess($totalProcess)
            ->setMachineId($machineId)
        ;

        /** @var EntityManagerInterface&\PHPUnit\Framework\MockObject\MockObject $entityManager */
        $entityManager = $this->createMock(EntityManagerInterface::class);
    
        /** @var IProcessRepository&\PHPUnit\Framework\MockObject\MockObject $processRepository */
        $processRepository = $this->createMock(IProcessRepository::class);
    
        $processService = new ProcessService($processRepository, $entityManager);

        $entityManager->expects($this->once())
            ->method('persist')
            ->with($process);

        $entityManager->expects($this->once())
            ->method('flush');

        $processService->save($processModel);
    }

    public static function provideTestDeleteProcessByIdNotFound(): array {
        return [
            'Несуществующий идентификатор процесса' => [
                'id' => 1
            ]
        ];
    }

    #[DataProvider('provideTestDeleteProcessByIdNotFound')]
    #[TestDox('Тест удаления машины, если прцоесс не существует')]
    public function testDeleteByIdProcessNotFound(int $id): void
    {
        /** @var IProcessRepository&\PHPUnit\Framework\MockObject\MockObject $processRepository */
        $processRepository = $this->createMock(IProcessRepository::class);
        
        /** @var EntityManagerInterface&\PHPUnit\Framework\MockObject\MockObject $em */
        $em = $this->createMock(EntityManagerInterface::class);

        $processRepository
            ->method('find')
            ->with($id)
            ->willReturn(null)
        ;

        $this->expectException(ValidateException::class);
        
        $this->expectExceptionMessage("Process with id: $id not found");

        $processService = new ProcessService($processRepository, $em);

        $processService->deleteById($id);
    }

    public static function provideTestDeleteProcessByIdFound(): array {
        return [
            'Характеристрики существующего процесса' => [
                'id' => 1,
                'totalProcess' => 10,
                'totalMemory' => 100,
                'machineId' => null
            ]
        ];
    }
    #[DataProvider('provideTestDeleteProcessByIdFound')]
    #[TestDox('Тест удаления машины, если машина существует')]
    public function testDeleteByIdProcessFound(int $id, int $totalProcess, int $totalMemory, ?int $machineId): void
    {
        $machine = (new Process())
            ->setId($id)
            ->setTotalMemory($totalMemory)
            ->setTotalProcess($totalProcess)
            ->setMachineId($machineId)
        ;

        /** @var IProcessRepository&\PHPUnit\Framework\MockObject\MockObject $processRepository */
        $processRepository = $this->createMock(IProcessRepository::class);

        /** @var EntityManagerInterface&\PHPUnit\Framework\MockObject\MockObject $em */
        $em = $this->createMock(EntityManagerInterface::class);

        $processService = new ProcessService($processRepository, $em);

        $processRepository
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

        $processService->deleteById($id);
        
    }
}