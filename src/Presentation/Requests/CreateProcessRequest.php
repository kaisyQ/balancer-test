<?php declare(strict_types=1);


namespace App\Presentation\Requests;

use App\Application\Models\ProcessModel;
use AutoMapper\Attribute\MapTo;
use Symfony\Component\Validator\Constraints as Assert;
use OpenApi\Attributes as OA;

#[OA\Schema(description: "Данные для создания нового процессв")]
final readonly class CreateProcessRequest 
{
    public function __construct(
        #[MapTo(target: ProcessModel::class, property: 'totalProcess')]
        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[OA\Property(description: "Кол-во процессов требуемых для работы процесса", example: 5)]
        public int $totalProcess,
    
        #[MapTo(target: ProcessModel::class, property: 'totalMemory')]
        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[OA\Property(description: "Кол-во памяти требуемое для работы процесса", example: 5)]
        public int $totalMemory
    ){}
}