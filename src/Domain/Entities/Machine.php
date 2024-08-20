<?php declare(strict_types=1);

namespace App\Domain\Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * Cущность рабочей машины
 */
#[ORM\Entity]
#[ORM\Table(name: "public.machines")]
class Machine
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    

    #[ORM\Column(name: 'total_process')]
    private int $totalProcess;

    #[ORM\Column(name: 'total_memory')]
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
