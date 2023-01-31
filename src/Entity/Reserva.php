<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $numReserva = null;

    #[ORM\ManyToOne(inversedBy: 'reservasJuego')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Juego $juegoReservado = null;

    #[ORM\ManyToOne(inversedBy: 'reservasUsuario')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuarioReserva = null;

    #[ORM\ManyToOne(inversedBy: 'reservasMesa')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mesa $mesaReserva = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumReserva(): ?string
    {
        return $this->numReserva;
    }

    public function setNumReserva(string $numReserva): self
    {
        $this->numReserva = $numReserva;

        return $this;
    }

    public function getJuegoReservado(): ?Juego
    {
        return $this->juegoReservado;
    }

    public function setJuegoReservado(?Juego $juegoReservado): self
    {
        $this->juegoReservado = $juegoReservado;

        return $this;
    }

    public function getUsuarioReserva(): ?Usuario
    {
        return $this->usuarioReserva;
    }

    public function setUsuarioReserva(?Usuario $usuarioReserva): self
    {
        $this->usuarioReserva = $usuarioReserva;

        return $this;
    }

    public function getMesaReserva(): ?Mesa
    {
        return $this->mesaReserva;
    }

    public function setMesaReserva(?Mesa $mesaReserva): self
    {
        $this->mesaReserva = $mesaReserva;

        return $this;
    }

}
