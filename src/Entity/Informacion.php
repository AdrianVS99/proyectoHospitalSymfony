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





    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Servicios $servicio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $informacion = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServicio(): ?Servicios
    {
        return $this->servicio;
    }
    public function setServicio(?Servicios $servicio): static
    {
        $this->servicio = $servicio;

        return $this;
    }

    public function getInformacion(): ?string
    {
        return $this->informacion;
    }

    public function setInformacion(?string $informacion): static
    {
        $this->informacion = $informacion;

        return $this;
    }
}
