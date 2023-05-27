<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $salle_reservee = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_heure_reservation = null;

    #[ORM\Column(length: 255)]
    private ?string $entreprise = null;

    #[ORM\OneToOne(mappedBy: 'capacité', cascade: ['persist', 'remove'])]
    private ?Salle $salle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalleReservee(): ?string
    {
        return $this->salle_reservee;
    }

    public function setSalleReservee(string $salle_reservee): self
    {
        $this->salle_reservee = $salle_reservee;

        return $this;
    }

    public function getDateHeureReservation(): ?\DateTimeInterface
    {
        return $this->date_heure_reservation;
    }

    public function setDateHeureReservation(\DateTimeInterface $date_heure_reservation): self
    {
        $this->date_heure_reservation = $date_heure_reservation;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(Salle $salle): self
    {
        
        $this->salle = $salle;

        return $this;
    }
    public function __toString(): string
{
    return $this->getSalleReservee(); // Return the salle_reservee property as a string representation
}
}
