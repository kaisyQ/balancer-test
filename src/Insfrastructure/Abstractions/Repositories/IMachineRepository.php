<?php declare(strict_types=1);

namespace App\Insfrastructure\Abstractions\Repositories;

use App\Domain\Entities\Machine;
use Doctrine\DBAL\LockMode;

interface IMachineRepository 
{
    /**
     * Finds a process by its identifier.
     *
     * @param int|string $id The identifier.
     * @param int|null $lockMode
     * @param int|null $lockVersion
     *
     * @return Machine|null The process or null if not found.
     */
    public function find(mixed $id, LockMode|int|null $lockMode = null, int|null $lockVersion = null): object|null;

    /**
     * Finds a process by a set of criteria.
     *
     * @param array $criteria The criteria.
     * @param array|null $orderBy The ordering.
     *
     * @return Machine|null The process or null if not found.
     */
    public function findOneBy(array $criteria, array $orderBy = null): object|null;

    /**
     * Finds all processes.
     *
     * @return Machine[] The processes.
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
     * @return Machine[] The processes.
     */
    public function findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null): array;
}
