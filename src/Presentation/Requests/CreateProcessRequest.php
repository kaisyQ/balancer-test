<?php declare(strict_types=1);


namespace App\Presentation\Requests;

use App\Application\Models\ProcessModel;
use AutoMapper\Attribute\MapTo;

final readonly class CreateProcessRequest 
{
    /**
     * @TODO добавить Assert
     */
    public function __construct(
        #[MapTo(target: ProcessModel::class, property: 'totalProcess')]
        public int $totalProcess,
    
        #[MapTo(target: ProcessModel::class, property: 'totalMemory')]
        public int $totalMemory
    ){}
}