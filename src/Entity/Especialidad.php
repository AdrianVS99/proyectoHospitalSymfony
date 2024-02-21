<?php

namespace App\Entity;

use App\Repository\EspecialidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspecialidadRepository::class)]
class Especialidad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToMany(targetEntity: Medico::class, mappedBy: 'especialidad')]
    private Collection $medicos;

    #[ORM\OneToMany(targetEntity: Citas::class, mappedBy: 'especialidad')]
    private Collection $citas;

    #[ORM\ManyToOne(inversedBy: 'especialidad')]
    private ?Informacion $informacion = null;

    public function __construct()
    {
        $this->medicos = new ArrayCollection();
        $this->citas = new ArrayCollection();
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

    /**
     * @return Collection<int, Medico>
     */
    public function getMedicos(): Collection
    {
        return $this->medicos;
    }

    public function addMedico(Medico $medico): static
    {
        if (!$this->medicos->contains($medico)) {
            $this->medicos->add($medico);
            $medico->addEspecialidad($this);
        }

        return $this;
    }

    public function removeMedico(Medico $medico): static
    {
        if ($this->medicos->removeElement($medico)) {
            $medico->removeEspecialidad($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Citas>
     */
    public function getCitas(): Collection
    {
        return $this->citas;
    }

    public function addCita(Citas $cita): static
    {
        if (!$this->citas->contains($cita)) {
            $this->citas->add($cita);
            $cita->setEspecialidad($this);
        }

        return $this;
    }

    public function removeCita(Citas $cita): static
    {
        if ($this->citas->removeElement($cita)) {
            // set the owning side to null (unless already changed)
            if ($cita->getEspecialidad() === $this) {
                $cita->setEspecialidad(null);
            }
        }

        return $this;
    }

    public function getInformacion(): ?Informacion
    {
        return $this->informacion;
    }

    public function setInformacion(?Informacion $informacion): static
    {
        $this->informacion = $informacion;

        return $this;
    }
}
