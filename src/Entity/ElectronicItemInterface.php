<?php

namespace App\Entity;

interface ElectronicItemInterface
{
    /**
     * Max extras
     *
     * Returns the maximum amount of extras of an ElectronicItem
     * There is no maximum when null
     *
     * @return int|null
     */
    public function maxExtras(): ?int;
}
