<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaisRepository")
 */
class Pais
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
    private $nombre_pais;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Equipo", mappedBy="pais_equipo")
     */
    private $equipos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Jugador", mappedBy="pais_jugador")
     */
    private $jugadores;

    public function __construct()
    {
        $this->equipos = new ArrayCollection();
        $this->jugadores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombrePais(): ?string
    {
        return $this->nombre_pais;
    }

    public function setNombrePais(string $nombre_pais): self
    {
        $this->nombre_pais = $nombre_pais;

        return $this;
    }

    /**
     * @return Collection|Equipo[]
     */
    public function getEquipos(): Collection
    {
        return $this->equipos;
    }

    public function addEquipo(Equipo $equipo): self
    {
        if (!$this->equipos->contains($equipo)) {
            $this->equipos[] = $equipo;
            $equipo->setPaisEquipo($this);
        }

        return $this;
    }

    public function removeEquipo(Equipo $equipo): self
    {
        if ($this->equipos->contains($equipo)) {
            $this->equipos->removeElement($equipo);
            // set the owning side to null (unless already changed)
            if ($equipo->getPaisEquipo() === $this) {
                $equipo->setPaisEquipo(null);
            }
        }

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
            $jugadore->setPaisJugador($this);
        }

        return $this;
    }

    public function removeJugadore(Jugador $jugadore): self
    {
        if ($this->jugadores->contains($jugadore)) {
            $this->jugadores->removeElement($jugadore);
            // set the owning side to null (unless already changed)
            if ($jugadore->getPaisJugador() === $this) {
                $jugadore->setPaisJugador(null);
            }
        }

        return $this;
    }
}
