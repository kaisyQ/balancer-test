<?php declare(strict_types=1);

namespace App\Tests\Unit;

use App\Application\UseCases\RebalanceProcessesUseCase;
use App\Application\Exceptions\ValidateException;
use App\Domain\Entities\Machine;
use App\Domain\Entities\Process;
use App\Infrastructure\Abstractions\Repositories\IMachineRepository;
use App\Infrastructure\Abstractions\Repositories\IProcessRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class RebalanceProcessesUseCaseTest extends TestCase
{
    private IMachineRepository&\PHPUnit\Framework\MockObject\MockObject $machineRepository;
    private IProcessRepository&\PHPUnit\Framework\MockObject\MockObject $processRepository;
    private EntityManagerInterface&\PHPUnit\Framework\MockObject\MockObject $em;

    protected function setUp(): void
    {
         /** @var IMachineRepository&\PHPUnit\Framework\MockObject\MockObject $machineRepository */
        $this->machineRepository = $this->createMock(IMachineRepository::class);
        
        /** @var IProcessRepository&\PHPUnit\Framework\MockObject\MockObject $processRepository */
        $this->processRepository = $this->createMock(IProcessRepository::class);
        
        /** @var EntityManagerInterface&\PHPUnit\Framework\MockObject\MockObject $entityManager */
        $this->em = $this->createMock(EntityManagerInterface::class);
    }


    #[TestDox("Тест работы исключения, когда нет машин")]
    public function testExceptionThrownWhenNoMachines(): void
    {
        $this->machineRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn([])
        ;

        $useCase = new RebalanceProcessesUseCase($this->processRepository, $this->machineRepository, $this->em);

        $this->expectException(ValidateException::class);
        
        $useCase->execute();
    }

    #[TestDox("Тест выхода корректного выхода из метода в случае если процессы отсутствуют")]
    public function testFunctionReturnsWithoutDoingAnythingWhenNoProcesses(): void
    {
        $this->machineRepository->expects($this->once())
            ->method('findAll')
            ->willReturn([new Machine()]);

        $this->processRepository->expects($this->once())
            ->method('findAll')
            ->willReturn([]);

        $useCase = new RebalanceProcessesUseCase($this->processRepository, $this->machineRepository, $this->em);

        $useCase->execute();

        // Никаких утверждений не требуется, просто убедитесь, что функция возвращает результат, ничего не делая
    }

    public static function provideTestProcessesAreCorrectlyAssignedToMachines(): array {
        return [
            'Существующие рабочие машины и процессы' => [
                'machinesData' => [
                    'Первая рабочая машина' => [
                        'id' => 1,
                        'totalMemory' => 100,
                        'totalProcess' => 10
                    ],
                    'Вторая рабочая машина' => [
                        'id' => 2,
                        'totalMemory' => 200,
                        'totalProcess' => 20
                    ]
                ],
                'processesData' => [
                    'Первый процесс' => [
                        'id' => 1,
                        'totalMemory' => 50,
                        'totalProcess' => 5
                    ],
                    'Второй процесс' => [
                        'id' => 2,
                        'totalMemory' => 150,
                        'totalProcess' => 15
                    ]
                ]
            ],
        ];
    } 

    #[DataProvider('provideTestProcessesAreCorrectlyAssignedToMachines')]
    #[TestDox('Тест распределения процессов по машинам')]
    public function testProcessesAreCorrectlyAssignedToMachines(array $machinesData, array $processesData): void
    {
        $machines = array_map(static fn (array $machineData): Machine => 
            (new Machine)
                ->setId($machineData['id'])
                ->setTotalMemory($machineData['totalMemory'])
                ->setTotalProcess($machineData['totalProcess'])
            ,
            $machinesData
        );

        $processes = array_map(static fn (array $processData): Process => 
            (new Process)
                ->setId($processData['id'])
                ->setTotalMemory($processData['totalMemory'])
                ->setTotalProcess($processData['totalProcess'])
                ->setMachineId(null)
            ,
            $processesData
        );
        $this->machineRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($machines);

        $this->processRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($processes);

        $useCase = new RebalanceProcessesUseCase($this->processRepository, $this->machineRepository, $this->em);

        $useCase->execute();

        $this->assertEquals(1, $processes['Первый процесс']->getMachineId());
        $this->assertEquals(2, $processes['Второй процесс']->getMachineId());
    }


    public static function provideTestProcessesArePersistedToDatabase(): array {
        return [
            'Существующие рабочие машины и процессы' => [
                'machinesData' => [
                    'Первая рабочая машина' => [
                        'id' => 1,
                        'totalMemory' => 100,
                        'totalProcess' => 10
                    ],
                    'Вторая рабочая машина' => [
                        'id' => 2,
                        'totalMemory' => 200,
                        'totalProcess' => 20
                    ]
                ],
                'processesData' => [
                    'Первый процесс' => [
                        'id' => 1,
                        'totalMemory' => 50,
                        'totalProcess' => 5
                    ],
                    'Второй процесс' => [
                        'id' => 2,
                        'totalMemory' => 150,
                        'totalProcess' => 15
                    ]
                ]
            ],
        ];
    } 

    #[DataProvider('provideTestProcessesArePersistedToDatabase')]
    #[TestDox('Тест сохранения обновленных процессов в базу')]
    public function testProcessesArePersistedToDatabase(array $machinesData, array $processesData): void
    {
        $machines = array_map(static fn (array $machineData): Machine => 
            (new Machine)
                ->setId($machineData['id'])
                ->setTotalMemory($machineData['totalMemory'])
                ->setTotalProcess($machineData['totalProcess'])
            ,
            $machinesData
        );

        $processes = array_map(static fn (array $processData): Process => 
            (new Process)
                ->setId($processData['id'])
                ->setTotalMemory($processData['totalMemory'])
                ->setTotalProcess($processData['totalProcess'])
                ->setMachineId(null)
            ,
            $processesData
        );

        $this->machineRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($machines);

        $this->processRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($processes);

        $this->em
            ->expects($this->exactly(2))
            ->method('persist');

        $this->em
            ->expects($this->once())
            ->method('flush');

        $useCase = new RebalanceProcessesUseCase($this->processRepository, $this->machineRepository, $this->em);

        $useCase->execute();
    }
}