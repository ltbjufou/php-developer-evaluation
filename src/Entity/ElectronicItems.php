<?php

namespace App\Entity;

use Exception;

class ElectronicItems
{
    /**
     * @var array
     */
    private array $items = [];

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Returns the items depending on the sorting type requested
     *
     * @param string $sortingType asc or desc
     * @return array
     * @throws Exception
     */
    public function getSortedItems(string $sortingType = 'asc'): array
    {
        $sorted = [];

        foreach ($this->getItems() as $item) {
            $sorted[($item->getTotalPrice() * 100)] = $item;
        }

        if ($sortingType === 'asc') {
            ksort($sorted, SORT_NUMERIC);
        } elseif ($sortingType === 'desc') {
            krsort($sorted, SORT_NUMERIC);
        } else {
            throw new Exception('Sorting type not supported (only asc|desc): ' . $sortingType . '.');
        }

        return $sorted;
    }

    /**
     * Get items by type
     *
     * Get only the Electronic Items of the selected type
     *
     * @param string $type
     * @return array
     * @throws Exception
     */
    public function getItemsByType(string $type): array
    {
        if (!in_array($type, ElectronicItem::FILTER_TYPES)) {
            throw new Exception('Not in supported types: ' . $type);
        }

        $callback = function($item) use ($type)
        {
            return $item->getType() == $type;
        };

        return array_filter($this->getItems(), $callback);
    }

    /**
     * Get total price
     *
     * The total price of all the items / including extras
     *
     * @return float
     */
    public function getTotalPrice(): float
    {
        $totalPrice = 0.00;

        foreach ($this->getItems() as $item) {
            $totalPrice += $item->getTotalPrice();
        }

        return $totalPrice;
    }
}
