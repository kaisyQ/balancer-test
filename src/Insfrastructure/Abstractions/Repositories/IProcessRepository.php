<?php declare(strict_types=1);

namespace App\Insfrastructure\Abstractions\Repositories;

use App\Domain\Entities\Process;
use Doctrine\DBAL\LockMode;


/** Интерфейс методов по работе с сущностью процесса */
interface IProcessRepository 
{
    /**
     * Метод поиска процесса по идентифкатору
     *
     * @param int|string $id The identifier.
     * @param int|null $lockMode
     * @param int|null $lockVersion
     *
     * @return Process|null
     */
    public function find(mixed $id, LockMode|int|null $lockMode = null, int|null $lockVersion = null): object|null;

    /**
     * Метод поиска ед. процесса по заданным критерияем
     *
     * @param array $criteria The criteria.
     * @param array|null $orderBy The ordering.
     *
     * @return Process|null
     */
    public function findOneBy(array $criteria, array $orderBy = null): object|null;

    /**
     * Метод поиска всех машин
     *
     * @return Process[] The processes.
     */
    public function findAll(): array;
    
    /**
     *  Метод поиска машин по заданным критериям
     *
     * @param array $criteria The criteria.
     * @param array|null $orderBy The ordering.
     * @param int|null $limit The limit.
     * @param int|null $offset The offset.
     *
     * @return Process[] Массив процессов
     */
    public function findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null): array;
}
