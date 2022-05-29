<?php
namespace App\Entity\ElectronicItem;

use App\Entity\ElectronicItem;

class Console extends ElectronicItem
{
    public function __construct(float $price)
    {
        $this->setType(parent::ELECTRONIC_ITEM_CONSOLE);
        $this->setPrice($price);
    }

    /**
     * @return int|null
     */
    public function maxExtras(): ?int
    {
        return 4;
    }
}
