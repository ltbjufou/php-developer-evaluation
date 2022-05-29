<?php
namespace App\Entity\ElectronicItem;

use App\Entity\ElectronicItem;

class Microwave extends ElectronicItem
{
    public function __construct(float $price)
    {
        $this->setType(parent::ELECTRONIC_ITEM_MICROWAVE);
        $this->setPrice($price);
    }
}
