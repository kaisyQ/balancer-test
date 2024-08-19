<?php declare(strict_types=1);

namespace App\Presentation\Requests;

use App\Application\Models\MachineModel;
use AutoMapper\Attribute\MapTo;

use Symfony\Component\Validator\Constraints as Assert;
final readonly class CreateMachineRequest 
{
    public function __construct(
        #[MapTo(target: MachineModel::class, property: 'totalProcess')]
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public int $totalProcess,
    
        #[MapTo(target: MachineModel::class, property: 'totalMemory')]
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public int $totalMemory
    ){}
}