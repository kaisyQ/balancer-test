<?php declare(strict_types=1);

namespace App\Application\Abstractions\Services;

use App\Application\Models\ProcessModel;


/**
 * Интерфейс класса сервиса для работы с процессами
 */
interface IProcessService 
{
    /**
     * Метод создания нового процесса
     *
     * @return void
     */

    public function save(ProcessModel $processModel): void;

    /**
     * Метод удаления процесса по id
     * 
     * @param int $id Идентификатор процесса
     */
    public function deleteById(int $id): void;

}
