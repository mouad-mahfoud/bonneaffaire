<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Panther\Client;

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
        $crawler = $client->request('GET', 'https://www.avito.ma/fr/maroc/voitures-à_vendre');
        $fullPageHtml = $crawler->html();
        $pageH1 = $crawler->filter('h1')->first()->text();
        $output->writeln([
            'avito : ',
            '============',
            $pageH1,
        ]);
    }
}