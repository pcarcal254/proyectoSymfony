<?php

namespace App\Entity;

use App\Repository\MesaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use CrEOF\Spatial\PHP\Types\Geometry\Point;

#[ORM\Entity(repositoryClass: MesaRepository::class)]
class Mesa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $nomMesa = null;

    #[ORM\Column]
    private ?int $anchoMesa = null;

    #[ORM\Column]
    private ?int $largoMesa = null;

    #[ORM\OneToMany(mappedBy: 'mesaReserva', targetEntity: Reserva::class)]
    private Collection $reservasMesa;

    #[ORM\Column(type: 'point')]
    private $predPoint = null;

    public function __construct()
    {
        $this->reservasMesa = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMesa(): ?string
    {
        return $this->nomMesa;
    }

    public function setNomMesa(string $nomMesa): self
    {
        $this->nomMesa = $nomMesa;

        return $this;
    }

    public function getAnchoMesa(): ?int
    {
        return $this->anchoMesa;
    }

    public function setAnchoMesa(int $anchoMesa): self
    {
        $this->anchoMesa = $anchoMesa;

        return $this;
    }

    public function getLargoMesa(): ?int
    {
        return $this->largoMesa;
    }

    public function setLargoMesa(int $largoMesa): self
    {
        $this->largoMesa = $largoMesa;

        return $this;
    }

    /**
     * @return Collection<int, Reserva>
     */
    public function getReservasMesa(): Collection
    {
        return $this->reservasMesa;
    }

    public function addReservasMesa(Reserva $reservasMesa): self
    {
        if (!$this->reservasMesa->contains($reservasMesa)) {
            $this->reservasMesa->add($reservasMesa);
            $reservasMesa->setMesaReserva($this);
        }

        return $this;
    }

    public function removeReservasMesa(Reserva $reservasMesa): self
    {
        if ($this->reservasMesa->removeElement($reservasMesa)) {
            // set the owning side to null (unless already changed)
            if ($reservasMesa->getMesaReserva() === $this) {
                $reservasMesa->setMesaReserva(null);
            }
        }

        return $this;
    }

    public function getPredPoint()
    {
        return $this->predPoint;
    }

    public function setPredPoint($predPoint): self
    {
        $this->predPoint = $predPoint;

        return $this;
    }
}
