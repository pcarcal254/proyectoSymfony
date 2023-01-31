<?php

namespace App\Entity;

use App\Repository\NotificacionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificacionRepository::class)]
class Notificacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomNotificacion = null;

    #[ORM\ManyToOne(inversedBy: 'notificacionesUsuario')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuarioNotificacion = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descReserva = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomNotificacion(): ?string
    {
        return $this->nomNotificacion;
    }

    public function setNomNotificacion(string $nomNotificacion): self
    {
        $this->nomNotificacion = $nomNotificacion;

        return $this;
    }

    public function getUsuarioNotificacion(): ?Usuario
    {
        return $this->usuarioNotificacion;
    }

    public function setUsuarioNotificacion(?Usuario $usuarioNotificacion): self
    {
        $this->usuarioNotificacion = $usuarioNotificacion;

        return $this;
    }

    public function getDescReserva(): ?string
    {
        return $this->descReserva;
    }

    public function setDescReserva(string $descReserva): self
    {
        $this->descReserva = $descReserva;

        return $this;
    }
}
