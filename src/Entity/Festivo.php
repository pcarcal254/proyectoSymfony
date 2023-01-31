<?php

namespace App\Entity;

use App\Repository\FestivoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FestivoRepository::class)]
class Festivo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nomFestivo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $diaFestivo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFestivo(): ?string
    {
        return $this->nomFestivo;
    }

    public function setNomFestivo(string $nomFestivo): self
    {
        $this->nomFestivo = $nomFestivo;

        return $this;
    }

    public function getDiaFestivo(): ?\DateTimeInterface
    {
        return $this->diaFestivo;
    }

    public function setDiaFestivo(\DateTimeInterface $diaFestivo): self
    {
        $this->diaFestivo = $diaFestivo;

        return $this;
    }
}
