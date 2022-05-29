<?php
namespace App\Entity\ElectronicItem;

class WiredController extends Controller
{
    public function __construct(float $price)
    {
        parent::__construct($price);
        $this->setWired(true);
    }
}
