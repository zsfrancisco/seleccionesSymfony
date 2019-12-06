<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JugadorRepository")
 */
class Jugador
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
     * @ORM\Column(type="integer")
     */
    private $edad;

    public function __construct($nombre=null, $edad=null)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pais", inversedBy="jugadores")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pais_jugador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipo", inversedBy="jugadores")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipo_jugador;

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

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getPaisJugador(): ?Pais
    {
        return $this->pais_jugador;
    }

    public function setPaisJugador(?Pais $pais_jugador): self
    {
        $this->pais_jugador = $pais_jugador;

        return $this;
    }

    public function getEquipoJugador(): ?Equipo
    {
        return $this->equipo_jugador;
    }

    public function setEquipoJugador(?Equipo $equipo_jugador): self
    {
        $this->equipo_jugador = $equipo_jugador;

        return $this;
    }
}
