<?php declare(strict_types=1);

namespace App\Application\Services;

use App\Application\Abstractions\Services\IProcessService;
use App\Application\Exceptions\ValidateException;
use App\Application\Models\ProcessModel;
use App\Domain\Entities\Process;
use App\Infrastructure\Abstractions\Repositories\IProcessRepository;
use AutoMapper\AutoMapper;
use Doctrine\ORM\EntityManagerInterface;

final readonly class ProcessService implements IProcessService
{
    public function __construct(
        private IProcessRepository $processRepository,
        private EntityManagerInterface $em,
    ){}

    public function save(ProcessModel $processModel): void
    {
        /** @var Process */
        $processEntity = AutoMapper::create()->map($processModel, Process::class);

        $this->em->persist($processEntity);
        
        $this->em->flush();
    }

    public function deleteById(int $id): void
    {
        $process = $this->processRepository->find($id);
    
        if ($process === null) {
            throw new ValidateException("Process with id: $id not found");
        }

        $this->em->remove($process);

        $this->em->flush();
    }
}