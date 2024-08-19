<?php declare(strict_types=1);

namespace App\Presentation\Requests;

use App\Application\Models\MachineModel;
use AutoMapper\Attribute\MapTo;

final readonly class CreateMachineRequest 
{


    /**
     * @TODO добавить Assert
     */
    public function __construct(
        #[MapTo(target: MachineModel::class, property: 'totalProcess')]
        public int $totalProcess,
    
        #[MapTo(target: MachineModel::class, property: 'totalMemory')]
        public int $totalMemory
    ){}
}