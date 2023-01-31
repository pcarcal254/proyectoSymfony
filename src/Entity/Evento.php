<?php

namespace App\Entity;

use App\Repository\EventoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventoRepository::class)]
class Evento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nomEvento = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descEvento = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $diaEvento = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEvento(): ?string
    {
        return $this->nomEvento;
    }

    public function setNomEvento(string $nomEvento): self
    {
        $this->nomEvento = $nomEvento;

        return $this;
    }

    public function getDescEvento(): ?string
    {
        return $this->descEvento;
    }

    public function setDescEvento(string $descEvento): self
    {
        $this->descEvento = $descEvento;

        return $this;
    }

    public function getDiaEvento(): ?\DateTimeInterface
    {
        return $this->diaEvento;
    }

    public function setDiaEvento(\DateTimeInterface $diaEvento): self
    {
        $this->diaEvento = $diaEvento;

        return $this;
    }
}
