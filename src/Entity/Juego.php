<?php

namespace App\Entity;

use App\Repository\JuegoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JuegoRepository::class)]
class Juego
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomJuego = null;

    #[ORM\Column]
    private ?int $jugadoresMin = null;

    #[ORM\Column]
    private ?int $jugadoresMax = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descJuego = null;

    #[ORM\Column]
    private ?int $tiempoMinJuego = null;

    #[ORM\Column]
    private ?int $tiempoMaxJuego = null;

    #[ORM\Column]
    private ?int $anchuraMinJuego = null;

    #[ORM\Column]
    private ?int $largoMinJuego = null;

    #[ORM\OneToMany(mappedBy: 'juegoReservado', targetEntity: Reserva::class)]
    private Collection $reservasJuego;

    public function __construct()
    {
        $this->reservasJuego = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomJuego(): ?string
    {
        return $this->nomJuego;
    }

    public function setNomJuego(string $nomJuego): self
    {
        $this->nomJuego = $nomJuego;

        return $this;
    }

    public function getJugadoresMin(): ?int
    {
        return $this->jugadoresMin;
    }

    public function setJugadoresMin(int $jugadoresMin): self
    {
        $this->jugadoresMin = $jugadoresMin;

        return $this;
    }

    public function getJugadoresMax(): ?int
    {
        return $this->jugadoresMax;
    }

    public function setJugadoresMax(int $jugadoresMax): self
    {
        $this->jugadoresMax = $jugadoresMax;

        return $this;
    }

    public function getDescJuego(): ?string
    {
        return $this->descJuego;
    }

    public function setDescJuego(string $descJuego): self
    {
        $this->descJuego = $descJuego;

        return $this;
    }

    public function getTiempoMinJuego(): ?int
    {
        return $this->tiempoMinJuego;
    }

    public function setTiempoMinJuego(int $tiempoMinJuego): self
    {
        $this->tiempoMinJuego = $tiempoMinJuego;

        return $this;
    }

    public function getTiempoMaxJuego(): ?int
    {
        return $this->tiempoMaxJuego;
    }

    public function setTiempoMaxJuego(int $tiempoMaxJuego): self
    {
        $this->tiempoMaxJuego = $tiempoMaxJuego;

        return $this;
    }

    public function getAnchuraMinJuego(): ?int
    {
        return $this->anchuraMinJuego;
    }

    public function setAnchuraMinJuego(int $anchuraMinJuego): self
    {
        $this->anchuraMinJuego = $anchuraMinJuego;

        return $this;
    }

    public function getLargoMinJuego(): ?int
    {
        return $this->largoMinJuego;
    }

    public function setLargoMinJuego(int $largoMinJuego): self
    {
        $this->largoMinJuego = $largoMinJuego;

        return $this;
    }

    /**
     * @return Collection<int, Reserva>
     */
    public function getReservasJuego(): Collection
    {
        return $this->reservasJuego;
    }

    public function addReservasJuego(Reserva $reservasJuego): self
    {
        if (!$this->reservasJuego->contains($reservasJuego)) {
            $this->reservasJuego->add($reservasJuego);
            $reservasJuego->setJuegoReservado($this);
        }

        return $this;
    }

    public function removeReservasJuego(Reserva $reservasJuego): self
    {
        if ($this->reservasJuego->removeElement($reservasJuego)) {
            // set the owning side to null (unless already changed)
            if ($reservasJuego->getJuegoReservado() === $this) {
                $reservasJuego->setJuegoReservado(null);
            }
        }

        return $this;
    }
}
