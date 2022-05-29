<?php
namespace App\Entity\ElectronicItem;

class RemoteController extends Controller
{
    public function __construct(float $price)
    {
        parent::__construct($price);
        $this->setWired(false);
    }
}
