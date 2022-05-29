<?php

use App\Entity\ElectronicItem;
use App\Entity\ElectronicItem\Console;
use App\Entity\ElectronicItem\Controller;
use App\Entity\ElectronicItem\Microwave;
use App\Entity\ElectronicItem\RemoteController;
use App\Entity\ElectronicItem\Television;
use App\Entity\ElectronicItem\WiredController;
use PHPUnit\Framework\TestCase;

class ElectronicItemTest extends TestCase
{
    public function testConsole()
    {
        $mainPrice = 1500.00;
        $item = new Console($mainPrice);
        $this->assertSame(ElectronicItem::ELECTRONIC_ITEM_CONSOLE, $item->getType());
        $this->assertSame($mainPrice, $item->getPrice());

        // Add up to the allowed max. No exception.
        for ($i=0; $i < $item->maxExtras(); ++$i) {
            $extra = new WiredController(60.00);
            $item->addExtras([$extra]);
        }

        // Add one more. No exception.
        $this->expectException(Exception::class);
        $extra = new Controller(75.00);
        $item->addExtras([$extra]);
    }

    public function testMicrowave()
    {
        $mainPrice = 1500.00;
        $item = new Microwave($mainPrice);
        $this->assertSame(ElectronicItem::ELECTRONIC_ITEM_MICROWAVE, $item->getType());
        $this->assertSame($mainPrice, $item->getPrice());

        // No extras allowed. Exception.
        $this->expectException(Exception::class);
        $extra = new WiredController(15.00);
        $item->addExtras([$extra]);
    }

    public function testTelevision()
    {
        $mainPrice = 1500.00;
        $item = new Television($mainPrice);
        $this->assertSame(ElectronicItem::ELECTRONIC_ITEM_TELEVISION, $item->getType());
        $this->assertSame($mainPrice, $item->getPrice());

        // No limitation. No exception.
        for ($i=0; $i < 10; ++$i) {
            $extra = new WiredController(60.00);
            $item->addExtras([$extra]);
        }
    }

    public function testWiredController()
    {
        $mainPrice = 1500.00;
        $item = new WiredController($mainPrice);
        $this->assertSame(ElectronicItem::ELECTRONIC_ITEM_CONTROLLER, $item->getType());
        $this->assertSame($mainPrice, $item->getPrice());
        $this->assertSame(true, $item->getWired());

        // No extras allowed. Exception.
        $this->expectException(Exception::class);
        $extra = new WiredController(60.00);
        $item->addExtras([$extra]);
    }

    public function testRemoteController()
    {
        $mainPrice = 1500.00;
        $item = new RemoteController($mainPrice);
        $this->assertSame(ElectronicItem::ELECTRONIC_ITEM_CONTROLLER, $item->getType());
        $this->assertSame($mainPrice, $item->getPrice());
        $this->assertSame(false, $item->getWired());

        // No extras allowed. Exception.
        $this->expectException(Exception::class);
        $extra = new WiredController(60.00);
        $item->addExtras([$extra]);
    }
}
