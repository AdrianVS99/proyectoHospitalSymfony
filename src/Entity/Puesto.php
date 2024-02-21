<?php

namespace App\Entity;

use App\Repository\PuestoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PuestoRepository::class)]
class Puesto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\OneToMany(targetEntity: Bolsa::class, mappedBy: 'puesto')]
    private Collection $bolsas;

    #[ORM\ManyToMany(targetEntity: Solicitudes::class, mappedBy: 'puesto')]
    private Collection $solicitudes;

    public function __construct()
    {
        $this->bolsas = new ArrayCollection();
        $this->solicitudes = new ArrayCollection();
    }


 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection<int, Bolsa>
     */
    public function getBolsas(): Collection
    {
        return $this->bolsas;
    }

    public function addBolsa(Bolsa $bolsa): static
    {
        if (!$this->bolsas->contains($bolsa)) {
            $this->bolsas->add($bolsa);
            $bolsa->setPuesto($this);
        }

        return $this;
    }

    public function removeBolsa(Bolsa $bolsa): static
    {
        if ($this->bolsas->removeElement($bolsa)) {
            // set the owning side to null (unless already changed)
            if ($bolsa->getPuesto() === $this) {
                $bolsa->setPuesto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Solicitudes>
     */
    public function getSolicitudes(): Collection
    {
        return $this->solicitudes;
    }

    public function addSolicitude(Solicitudes $solicitude): static
    {
        if (!$this->solicitudes->contains($solicitude)) {
            $this->solicitudes->add($solicitude);
            $solicitude->addPuesto($this);
        }

        return $this;
    }

    public function removeSolicitude(Solicitudes $solicitude): static
    {
        if ($this->solicitudes->removeElement($solicitude)) {
            $solicitude->removePuesto($this);
        }

        return $this;
    }




}
