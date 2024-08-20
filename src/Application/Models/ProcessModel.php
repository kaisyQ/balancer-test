<?php declare(strict_types=1);

namespace App\Application\Models;

use App\Domain\Entities\Process;
use AutoMapper\Attribute\MapFrom;
use AutoMapper\Attribute\MapTo;


/**
 * Модель процесса
 */
final class ProcessModel
{

    #[MapTo(target: Process::class, property: 'id')]
    #[MapFrom(source: Process::class, property: 'id')]
    private ?int $id = null;

    #[MapTo(target: Process::class, property: 'totalMemory')]
    #[MapFrom(source: Process::class, property: 'totalMemory')]
    private int $totalMemory;

    #[MapTo(target: Process::class, property: 'totalProcess')]
    #[MapFrom(source: Process::class, property: 'totalProcess')]
    private int $totalProcess;

    #[MapTo(target: Process::class, property: 'machineId')]
    #[MapFrom(source: Process::class, property: 'machineId')]
    private ?int $machineId = null;

    public function setId(?int $id): self 
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTotalProcess(): int
    {
        return $this->totalProcess;
    }

    public function setTotalProcess(int $totalProcess): self
    {
        $this->totalProcess = $totalProcess;

        return $this;
    }

    public function getMachineId(): ?int
    {
        return $this->machineId;
    }

    public function setMachineId(?int $machineId): self
    {
        $this->machineId = $machineId;

        return $this;
    }
} 