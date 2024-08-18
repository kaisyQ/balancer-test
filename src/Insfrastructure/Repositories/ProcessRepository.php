<?php declare(strict_types=1);

namespace App\Infrastructure\Repositories;


use App\Domain\Entities\Process;
use App\Insfrastructure\Abstractions\Repositories\IProcessRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Process>
 *
 * @method Process|null find($id, $lockMode = null, $lockVersion = null)
 * @method Process|null findOneBy(array $criteria, array $orderBy = null)
 * @method Process[]    findAll()
 * @method Process[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class ProcessRepository extends ServiceEntityRepository implements IProcessRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Process::class);
    }
}
