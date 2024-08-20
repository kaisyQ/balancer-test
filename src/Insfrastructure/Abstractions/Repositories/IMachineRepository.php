<?php declare(strict_types=1);

namespace App\Insfrastructure\Abstractions\Repositories;

use App\Domain\Entities\Machine;
use Doctrine\DBAL\LockMode;

/** Интерфейс методов по работе с сущностью машины */
interface IMachineRepository 
{
    /**
     * Метод поиска машины по идентификатору
     *
     * @param int|string $id The identifier.
     * @param int|null $lockMode
     * @param int|null $lockVersion
     *
     * @return Machine|null
     */
    public function find(mixed $id, LockMode|int|null $lockMode = null, int|null $lockVersion = null): object|null;

    /**
     * Метод поиска ед. машины по заданным критерияем
     *
     * @param array $criteria The criteria.
     * @param array|null $orderBy The ordering.
     *
     * @return Machine|null
     */
    public function findOneBy(array $criteria, array $orderBy = null): object|null;

    /**
     * Метод поиска всех машин
     *
     * @return Machine[] Список машин
     */
    public function findAll(): array;
    
    /**
     * Метод поиска машин по заданным критериям
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
