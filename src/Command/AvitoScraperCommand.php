<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\DomCrawler\Crawler;

class AvitoScraperCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:avito-scraper';

    protected function configure()
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = Client::createChromeClient();
        $cars = [];
        for ($i = 1; $i <= 1; $i++) {
            $crawler = $client->request('GET', 'https://www.avito.ma/fr/maroc/voitures-à_vendre?o=' . $i);
            $nodeValues = $crawler->filter('h2[class=fs14]')->each(function (Crawler $node, $i) {
                return $node->children('a')->attr('href');
            });


            foreach ($nodeValues as $link) {
                $crawler = $client->request('GET', $link);
                $car = new Car();
            }

            $output->writeln([
                '============',
            ]);
        }

    }
}
