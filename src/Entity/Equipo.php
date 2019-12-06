<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipoRepository")
 */
class Equipo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pais", inversedBy="equipos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pais_equipo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Jugador", mappedBy="equipo_jugador")
     */
    private $jugadores;

    public function __construct()
    {
        $this->jugadores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPaisEquipo(): ?Pais
    {
        return $this->pais_equipo;
    }

    public function setPaisEquipo(?Pais $pais_equipo): self
    {
        $this->pais_equipo = $pais_equipo;

        return $this;
    }

    /**
     * @return Collection|Jugador[]
     */
    public function getJugadores(): Collection
    {
        return $this->jugadores;
    }

    public function addJugadore(Jugador $jugadore): self
    {
        if (!$this->jugadores->contains($jugadore)) {
            $this->jugadores[] = $jugadore;
            $jugadore->setEquipoJugador($this);
        }

        return $this;
    }

    public function removeJugadore(Jugador $jugadore): self
    {
        if ($this->jugadores->contains($jugadore)) {
            $this->jugadores->removeElement($jugadore);
            // set the owning side to null (unless already changed)
            if ($jugadore->getEquipoJugador() === $this) {
                $jugadore->setEquipoJugador(null);
            }
        }

        return $this;
    }
}
