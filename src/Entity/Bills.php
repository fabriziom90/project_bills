<?php

namespace App\Entity;

use App\Repository\BillsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BillsRepository::class)
 */
class Bills
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="fkBill")
     */
    private $fkUser;

    /**
     * @ORM\OneToOne(targetEntity=BillRows::class, inversedBy="fkBill", cascade={"persist", "remove"})
     */
    private $fkBillRows;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getFkUser(): ?User
    {
        return $this->fkUser;
    }

    public function setFkUser(?User $fkUser): self
    {
        $this->fkUser = $fkUser;

        return $this;
    }

    public function getFkBillRows(): ?BillRows
    {
        return $this->fkBillRows;
    }

    public function setFkBillRows(?BillRows $fkBillRows): self
    {
        $this->fkBillRows = $fkBillRows;

        return $this;
    }
    
}
