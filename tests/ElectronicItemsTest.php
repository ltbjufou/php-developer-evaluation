<?php

use App\Entity\ElectronicItem;
use App\Entity\ElectronicItem\Console;
use App\Entity\ElectronicItem\Microwave;
use App\Entity\ElectronicItem\RemoteController;
use App\Entity\ElectronicItem\Television;
use App\Entity\ElectronicItem\WiredController;
use App\Entity\ElectronicItems;
use PHPUnit\Framework\TestCase;

class ElectronicItemsTest extends TestCase
{
    private ElectronicItems $electronicItems;

    protected function setUp(): void
    {
        $remoteController1 = new RemoteController(75.00);
        $remoteController2 = new RemoteController(70.00);
        $wiredController1 = new WiredController(65.00);
        $wiredController2 = new WiredController(60.00);

        $console = new Console(500.00);
        $console->addExtras([$remoteController1, $remoteController2, $wiredController1, $wiredController2]);

        $television1 = new Television(1000.00);
        $television1->addExtras([$remoteController1, $remoteController2]);

        $television2 = new Television(1200.00);
        $television2->addExtras([$remoteController1]);

        $microwave = new Microwave(150);

        $this->electronicItems = new ElectronicItems([
            $console,
            $television1,
            $television2,
            $microwave
        ]);
    }

    public function testGetSortedItemsAsc() {
        $sortedPricesAsc = [];

        foreach ($this->electronicItems->getSortedItems('asc') as $sortedItem) {
            $sortedPricesAsc[] = $sortedItem->getTotalPrice();
        }

        $this->assertSame([
            150.00,
            770.00,
            1145.00,
            1275.00
        ], $sortedPricesAsc);
    }

    public function testGetSortedItemsDesc() {
        $sortedPricesAsc = [];

        foreach ($this->electronicItems->getSortedItems('desc') as $sortedItem) {
            $sortedPricesAsc[] = $sortedItem->getTotalPrice();
        }

        $this->assertSame([
            1275.00,
            1145.00,
            770.00,
            150.00
        ], $sortedPricesAsc);
    }

    public function testGetTotalPrice() {
        $this->assertSame(3340.00, $this->electronicItems->getTotalPrice());
    }

    public function testGetItemsByTypeTelevision() {
        $remoteController1 = new RemoteController(75.00);
        $remoteController2 = new RemoteController(70.00);

        $television1 = new Television(1000.00);
        $television1->addExtras([$remoteController1, $remoteController2]);

        $microwave = new Microwave(150);

        $electronicItems = new ElectronicItems([
            $television1,
            $microwave
        ]);

        $this->assertSame([
            $television1
        ], $electronicItems->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_TELEVISION));
    }

    public function testGetItemsByTypeControllerThrowsException() {
        $remoteController1 = new RemoteController(75.00);
        $electronicItems = new ElectronicItems([
            $remoteController1
        ]);

        $this->expectException(Exception::class);
        $electronicItems->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_CONTROLLER);
    }
}
