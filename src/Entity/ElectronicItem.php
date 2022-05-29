<?php

namespace App\Entity;

use Exception;

abstract class ElectronicItem implements ElectronicItemInterface
{
    /**
     * @var float
     */
    private float $price;

    /**
     * @var string
     */
    private string $type;

    /**
     * @var bool
     */
    private bool $wired = true;

    private array $extras = [];

    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    const ELECTRONIC_ITEM_CONTROLLER = 'controller';

    const FILTER_TYPES = [
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE,
        self::ELECTRONIC_ITEM_TELEVISION
    ];

    /**
     * @return float
     */
    function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    function getType(): string
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    function getWired(): bool
    {
        return $this->wired;
    }

    /**
     * @param float $price
     * @return void
     */
    function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param string $type
     * @return void
     */
    function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @param bool $wired
     * @return void
     */
    function setWired(bool $wired): void
    {
        $this->wired = $wired;
    }

    /**
     * @return array
     */
    public function getExtras(): array
    {
        return $this->extras;
    }

    /**
     * @param array $extras
     * @throws Exception
     */
    public function addExtras(array $extras): void
    {
        if ($this->maxExtras() !== null && $this->maxExtras() - count($this->getExtras()) < count($extras)) {
            throw new Exception(
                'You have reached the maximum amount of extras: ' . $this->maxExtras() . '.' .
                'You are trying to add ' . count($extras) . ' extras.'
            );
        }
        foreach ($extras as $extra) {
            $this->extras[] = $extra;
        }
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->getPrice() + $this->getPriceForExtras();
    }

    /**
     * @return float
     */
    public function getPriceForExtras(): float
    {
        $totalPrice = 0;

        foreach ($this->getExtras() as $extra) {
            $totalPrice += $extra->getPrice();
        }

        return $totalPrice;
    }

    /**
     * @return int|null
     */
    public function maxExtras(): ?int
    {
        return 0;
    }
}
