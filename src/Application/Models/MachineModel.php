<?php declare(strict_types=1);

namespace App\Application\Models;

use App\Domain\Entities\Machine;
use AutoMapper\Attribute\MapFrom;
use AutoMapper\Attribute\MapTo;

final class MachineModel 
{
    #[MapTo(target: Machine::class, property: 'id')]
    #[MapFrom(source: Machine::class, property: 'id')]
    private ?int $id = null;

    #[MapTo(target: Machine::class, property: 'totalProcess')]
    #[MapFrom(source: Machine::class, property: 'totalProcess')]
    private int $totalProcess;

    #[MapTo(target: Machine::class, property: 'totalMemory')]
    #[MapFrom(source: Machine::class, property: 'totalMemory')]
    private int $totalMemory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTotalProcess(): int
    {
        return $this->totalProcess;
    }

    public function setTotalProcess(int $totalProcess): self
    {
        $this->totalProcess = $totalProcess;

        return $this;
    }

    public function getTotalMemory(): int
    {
        return $this->totalMemory;
    }

    public function setTotalMemory(int $totalMemory): self
    {
        $this->totalMemory = $totalMemory;

        return $this;
    }


}