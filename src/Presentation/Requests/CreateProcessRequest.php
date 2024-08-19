<?php declare(strict_types=1);


namespace App\Presentation\Requests;

use App\Application\Models\ProcessModel;
use AutoMapper\Attribute\MapTo;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class CreateProcessRequest 
{
    public function __construct(
        #[MapTo(target: ProcessModel::class, property: 'totalProcess')]
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public int $totalProcess,
    
        #[MapTo(target: ProcessModel::class, property: 'totalMemory')]
        #[Assert\NotBlank]
        #[Assert\NotNull]
        public int $totalMemory
    ){}
}