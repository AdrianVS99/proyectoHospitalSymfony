<?php

namespace App\Entity;

use App\Repository\MedicoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicoRepository::class)]
class Medico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellido1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $apellido2 = null;

    #[ORM\ManyToMany(targetEntity: Especialidad::class, inversedBy: 'medicos')]
    private Collection $especialidad;

    #[ORM\OneToMany(targetEntity: Informacion::class, mappedBy: 'medico')]
    private Collection $informacions;

    public function __construct()
    {
        $this->especialidad = new ArrayCollection();
        $this->informacions = new ArrayCollection();
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

    public function getApellido1(): ?string
    {
        return $this->apellido1;
    }

    public function setApellido1(string $apellido1): static
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    public function getApellido2(): ?string
    {
        return $this->apellido2;
    }

    public function setApellido2(?string $apellido2): static
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    /**
     * @return Collection<int, Especialidad>
     */
    public function getEspecialidad(): Collection
    {
        return $this->especialidad;
    }

    public function addEspecialidad(Especialidad $especialidad): static
    {
        if (!$this->especialidad->contains($especialidad)) {
            $this->especialidad->add($especialidad);
        }

        return $this;
    }

    public function removeEspecialidad(Especialidad $especialidad): static
    {
        $this->especialidad->removeElement($especialidad);

        return $this;
    }

    /**
     * @return Collection<int, Informacion>
     */
    public function getInformacions(): Collection
    {
        return $this->informacions;
    }

    public function addInformacion(Informacion $informacion): static
    {
        if (!$this->informacions->contains($informacion)) {
            $this->informacions->add($informacion);
            $informacion->setMedico($this);
        }

        return $this;
    }

    public function removeInformacion(Informacion $informacion): static
    {
        if ($this->informacions->removeElement($informacion)) {
            // set the owning side to null (unless already changed)
            if ($informacion->getMedico() === $this) {
                $informacion->setMedico(null);
            }
        }

        return $this;
    }
}
