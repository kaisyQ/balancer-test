<?php declare(strict_types=1);

namespace App\Insfrastructure\Abstractions\Repositories;

use App\Domain\Entities\Process;
use Doctrine\DBAL\LockMode;

/**
 * Interface IProcessRepository
 *
 * Represents a repository of Process entities.
 */
interface IProcessRepository 
{
    /**
     * Finds a process by its identifier.
     *
     * @param int|string $id The identifier.
     * @param int|null $lockMode
     * @param int|null $lockVersion
     *
     * @return Process|null The process or null if not found.
     */
    public function find(mixed $id, LockMode|int|null $lockMode = null, int|null $lockVersion = null): object|null;

    /**
     * Finds a process by a set of criteria.
     *
     * @param array $criteria The criteria.
     * @param array|null $orderBy The ordering.
     *
     * @return Process|null The process or null if not found.
     */
    public function findOneBy(array $criteria, array $orderBy = null): object|null;

    /**
     * Finds all processes.
     *
     * @return Process[] The processes.
     */
    public function findAll(): array;
    
    /**
     * Finds processes by a set of criteria.
     *
     * @param array $criteria The criteria.
     * @param array|null $orderBy The ordering.
     * @param int|null $limit The limit.
     * @param int|null $offset The offset.
     *
     * @return Process[] The processes.
     */
    public function findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null): array;
}
