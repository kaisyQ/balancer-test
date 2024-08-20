<?php declare(strict_types=1);

namespace App\Presentation\Requests;

use App\Application\Models\MachineModel;
use AutoMapper\Attribute\MapTo;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

#[OA\Schema(description: "Данные для создания новой машины")]
final readonly class CreateMachineRequest 
{
    public function __construct(
        #[MapTo(target: MachineModel::class, property: 'totalProcess')]
        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[OA\Property(description: "Кол-во процессов рабочей машины", example: 20)]
        public int $totalProcess,
    
        #[MapTo(target: MachineModel::class, property: 'totalMemory')]
        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[OA\Property(description: "Кол-во памяти рабочей машины", example: 30)]
        public int $totalMemory
    ){}
}