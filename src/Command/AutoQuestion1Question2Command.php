<?php

namespace App\Command;

use App\Entity\ElectronicItem;
use App\Entity\ElectronicItem\Console;
use App\Entity\ElectronicItem\Microwave;
use App\Entity\ElectronicItem\RemoteController;
use App\Entity\ElectronicItem\Television;
use App\Entity\ElectronicItem\WiredController;
use App\Entity\ElectronicItems;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AutoQuestion1Question2Command extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:auto-question1-question2';

    /**
     * @var string
     */
    protected static $defaultDescription = 'Executes the scenario (Questions 1 and 2) without user input.';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $remoteController1 = new RemoteController(75.00);
        $remoteController2 = new RemoteController(70.00);
        $wiredController1 = new WiredController(65.00);
        $wiredController2 = new WiredController(60.00);

        $console = new Console(500.00);
        $console->addExtras([$remoteController1, $remoteController2, $wiredController1, $wiredController2]);

        $output->writeln('<comment>Buying a Console. Price: 500$</comment>');
        $output->writeln('<comment>Adding extra Remote Controller. Price: 75$</comment>');
        $output->writeln('<comment>Adding extra Remote Controller. Price: 70$</comment>');
        $output->writeln('<comment>Adding extra Wired Controller. Price: 65$</comment>');
        $output->writeln('<comment>Adding extra Wired Controller. Price: 60$</comment>');

        $television1 = new Television(1000.00);
        $television1->addExtras([$remoteController1, $remoteController2]);

        $output->writeln('');
        $output->writeln('<comment>Buying #1 Television. Price: 1000$</comment>');
        $output->writeln('<comment>Adding extra Remote Controller. Price: 75$</comment>');
        $output->writeln('<comment>Adding extra Remote Controller. Price: 70$</comment>');

        $television2 = new Television(1200.00);
        $television2->addExtras([$remoteController1]);

        $output->writeln('');
        $output->writeln('<comment>Buying #2 Television. Price: 1200$</comment>');
        $output->writeln('<comment>Adding extra Remote Controller. Price: 75$</comment>');

        $microwave = new Microwave(150);

        $output->writeln('');
        $output->writeln('<comment>Buying a Microwave. Price: 150$</comment>');

        $electronicItems = new ElectronicItems([
            $console,
            $television1,
            $television2,
            $microwave
        ]);

        $output->writeln('');
        $output->writeln(
            '<question>Question 1: Sort the items by price and output the total pricing.</question>'
        );
        $output->writeln('');

        foreach ($electronicItems->getSortedItems('asc') as $item) {
            $output->writeln(
                '<comment>' . ucfirst($item->getType()) . '. ' .
                'Price: ' . $item->getTotalPrice() . '$</comment>'
            );
        }

        $output->writeln('');
        $output->writeln('<comment>The total price is: ' . $electronicItems->getTotalPrice() . '$</comment>');

        $output->writeln(
            '<question>
Question 2: That person\'s friend saw her with her new purchase and asked her how much the
console and its controllers had cost her. Give the answer.</question>'
        );
        $output->writeln('');

        foreach ($electronicItems->getItemsByType(ElectronicItem::ELECTRONIC_ITEM_CONSOLE) as $item) {
            $output->writeln(
                '<comment>' . ucfirst($item->getType()) .
                '. Price for main item: ' . $item->getPrice() . '$. Price for extra controllers: ' . $item->getPriceForExtras() . '$</comment>'
            );
        }

        return Command::SUCCESS;
    }
}
