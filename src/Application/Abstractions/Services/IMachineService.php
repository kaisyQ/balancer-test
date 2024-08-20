<?php declare(strict_types=1);

namespace App\Application\Abstractions\Services;

use App\Application\Models\MachineModel;

/**
 * Интерфейс класса сервиса для работы с рабочими машинами
 */
interface IMachineService 
{
    /**
     * Метод создания новой рабочей машины
     */
    public function save(MachineModel $machine): void;

    /**
     * Метод удаления машины по её id
     * 
     * @param int $id Идентификатор машины
     * 
     */
    public function deleteById(int $id): void;
}
