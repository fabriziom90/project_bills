<?php

namespace App\Entity;

use App\Repository\BillRowsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BillRowsRepository::class)
 */
class BillRows
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $amount_iva_free;

    /**
     * @ORM\Column(type="float")
     */
    private $amount_iva_included;

    /**
     * @ORM\Column(type="float")
     */
    private $total_iva_included;

    /**
     * @ORM\OneToOne(targetEntity=Bills::class, mappedBy="fkBillRows")
     */
    private $fkBill;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAmountIvaFree(): ?float
    {
        return $this->amount_iva_free;
    }

    public function setAmountIvaFree(float $amount_iva_free): self
    {
        $this->amount_iva_free = $amount_iva_free;

        return $this;
    }

    public function getAmountIvaIncluded(): ?float
    {
        return $this->amount_iva_included;
    }

    public function setAmountIvaIncluded(float $amount_iva_included): self
    {
        $this->amount_iva_included = $amount_iva_included;

        return $this;
    }

    public function getTotalIvaIncluded(): ?float
    {
        return $this->total_iva_included;
    }

    public function setTotalIvaIncluded(float $total_iva_included): self
    {
        $this->total_iva_included = $total_iva_included;

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
        $newFkBillRow = null === $fkBill ? null : $this;
        if ($fkBill->getFkBillRows() !== $newFkBillRow) {
            $fkBill->setFkBillRows($newFkBillRow);
        }

        return $this;
    }
}
