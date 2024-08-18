<?php declare(strict_types=1);

namespace App\Application\Abstractions\Services;

use App\Application\Models\MachineModel;

interface IMachineService 
{
    public function save(MachineModel $machine): void;

    public function deleteById(int $id): void;
}