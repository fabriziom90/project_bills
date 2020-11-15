<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\OneToOne(targetEntity=Bills::class, mappedBy="fkUser")
     */
    private $fkBill;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getFkBill(): ?Bills
    {
        return $this->fkBill;
    }

    public function setFkBill(?Bills $fkBill): self
    {
        $this->fkBill = $fkBill;

        // set (or unset) the owning side of the relation if necessary
        $newFkUser = null === $fkBill ? null : $this;
        if ($fkBill->getFkUser() !== $newFkUser) {
            $fkBill->setFkUser($newFkUser);
        }

        return $this;
    }
}
