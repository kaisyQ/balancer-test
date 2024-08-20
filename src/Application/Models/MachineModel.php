<?php declare(strict_types=1);

namespace App\Application\Models;

use App\Domain\Entities\Machine;
use AutoMapper\Attribute\MapFrom;
use AutoMapper\Attribute\MapTo;

/**
 * Модель рабочей машины
 */
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

    private int $loadedMemory = 0;

    private int $loadedProcess = 0;

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

    public function getLoadedMemory(): int 
    {
        return $this->loadedMemory;
    }

    public function setLoadedMemory(int $loadedMemory): self 
    {
        $this->loadedMemory = $loadedMemory;

        return $this;
    }

    public function getLoadedProcess(): int 
    {
        return $this->loadedProcess;
    }

    public function setLoadedProcess(int $loadedProcess): self 
    {
        $this->loadedProcess = $loadedProcess;

        return $this;
    }

    public function getTotalLoad(): float
    {
        return ($this->getLoadedMemory() + $this->getLoadedProcess()) / ($this->getTotalMemory() + $this->getTotalProcess());
    }

}