<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\DomCrawler\Crawler;
use App\Document\Car;
use Symfony\Component\Config\Definition\Exception\Exception;

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

            foreach ($nodeValues as $key => $link) {
                
                $crawler = $client->request('GET', $link);
                
                $car = new Car();
                $cars = [];

                if ($crawler->filter('h1')->count() > 0 ) {
                    $title = $crawler->filter('h1')->text();
                }

                if ($crawler->filter('.vi-price-label.text-center.fs18.no-margin .amount.value')->count() > 0 ) {
                    $price = $crawler->filter('.vi-price-label.text-center.fs18.no-margin .amount.value')->attr('title');
                }
                
                if ($crawler->filter('.span8 aside ul li:nth-child(1) h2 a')->count() > 0 ) {
                    $modelYear = $crawler->filter('.span8 aside ul li:nth-child(1) h2 a')->text();
                }
               
                
                if ($crawler->filter('.span8 aside ul li:nth-child(2) h2')->count() > 0) {
                    $mileage = $crawler->filter('.span8 aside ul li:nth-child(2) h2')->text();
                }
                

                if ($crawler->filter('.span8 aside ul li:nth-child(3) h2 a')->count() > 0) {
                    $fuelType = $crawler->filter('.span8 aside ul li:nth-child(3) h2 a')->text();
                }
                
                if ($crawler->filter('.span8 aside ul li:nth-child(4) h2 a')->count() > 0) {
                    $mark = $crawler->filter('.span8 aside ul li:nth-child(4) h2 a')->text();
                }
                
                
                if ($crawler->filter('.span8 aside ul li:nth-child(5) h2 a')->count() > 0) {
                    $model = $crawler->filter('.span8 aside ul li:nth-child(5) h2 a')->text();
                }
                
                if ($crawler->filter('.span8 aside ul li:nth-child(6) h2 a')->count() > 0) {
                    $fiscalPower = $crawler->filter('.span8 aside ul li:nth-child(6) h2 a')->text();
                }
               
                
                if ($crawler->filter('.font-normal.fs13.lh30.no-margin')->count() > 0) {
                    $city = $crawler->filter('.font-normal.fs13.lh30.no-margin')->text();
                }
                
                
                if ($crawler->filter('.date.dtstart.value')->count() > 0) {
                    $postedAt = $crawler->filter('.date.dtstart.value')->attr('title');
                }
                
                if ($crawler->filter('.date.dtstart.value')->count() > 0) {
                    $postedAt = $crawler->filter('.date.dtstart.value')->attr('title');
                }
               
                if ($crawler->filter('.span20')->first()->filter('.panel')->first()->filter('span')->count() > 0) {
                    $views = $crawler->filter('.span20')->first()->filter('.panel')->first()->filter('span')->text();
                }
                
                dump([
                    "Title" => $title,
                    "Price" => $price,
                    "ModelYear" => $modelYear,
                    "Mileage" => $mileage,
                    "FuelType" => $fuelType,
                    "Mark" => $mark,
                    "Model" => $model,
                    "FiscalPower" => $fiscalPower,
                    "City" => $city,
                    "PostedAt" => $postedAt,
                    "Views" => $views,
                    "Link" => $link
                ]);



                // $car->setName();
                // $car->setPrice();
                // $car->setModelYear();
                // $car->setMileage();
                // $car->setFuelType();
                // $car->setMark();
                // $car->setFiscalPower();
                // $car->setCity();
                // $car->setPostedAt();
                // $car->setImages();
                // $car->setViews();
                $output->writeln('<< '.$key.' >>');
            }

            $output->writeln('End');
        }

    }
}
