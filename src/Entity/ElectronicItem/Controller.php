<?php
namespace App\Entity\ElectronicItem;

use App\Entity\ElectronicItem;

class Controller extends ElectronicItem
{
    public function __construct(float $price)
    {
        $this->setType(parent::ELECTRONIC_ITEM_CONTROLLER);
        $this->setPrice($price);
    }
}
