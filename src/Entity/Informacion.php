<?php

namespace App\Entity;

use App\Repository\InformacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InformacionRepository::class)]
class Informacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'informacions')]
    private ?Medico $medico = null;

    #[ORM\OneToMany(targetEntity: especialidad::class, mappedBy: 'informacion')]
    private Collection $especialidad;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?servicios $servicio = null;

    public function __construct()
    {
        $this->especialidad = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedico(): ?Medico
    {
        return $this->medico;
    }

    public function setMedico(?Medico $medico): static
    {
        $this->medico = $medico;

        return $this;
    }

    /**
     * @return Collection<int, especialidad>
     */
    public function getEspecialidad(): Collection
    {
        return $this->especialidad;
    }

    public function addEspecialidad(especialidad $especialidad): static
    {
        if (!$this->especialidad->contains($especialidad)) {
            $this->especialidad->add($especialidad);
            $especialidad->setInformacion($this);
        }

        return $this;
    }

    public function removeEspecialidad(especialidad $especialidad): static
    {
        if ($this->especialidad->removeElement($especialidad)) {
            // set the owning side to null (unless already changed)
            if ($especialidad->getInformacion() === $this) {
                $especialidad->setInformacion(null);
            }
        }

        return $this;
    }

    public function getServicio(): ?servicios
    {
        return $this->servicio;
    }

    public function setServicio(?servicios $servicio): static
    {
        $this->servicio = $servicio;

        return $this;
    }
}
