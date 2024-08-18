<?php declare(strict_types=1);

namespace App\Application\Abstractions\Services;

use App\Application\Models\ProcessModel;

/**
 * Interface IProcessService
 *
 * Represents an abstraction of service for Process entity.
 *
 * @package App\Application\Abstractions\Services
 */
interface IProcessService 
{
    /**
     * Saves the Process.
     *
     * @return void
     */

    public function save(ProcessModel $processModel): void;

    /**
     * Deletes the Process by id.
     *
     * @return void
     */
    public function deleteById(int $id): void;

}
