<?php

namespace App\Command;

use Facebook\WebDriver\Exception\WebDriverCurlException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\DomCrawler\Crawler;
use App\Document\Car;
use Doctrine\ODM\MongoDB\DocumentManager;

class AvitoScraperCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:avito-scraper';
    private $documentManager;
    private $logger;

    protected function configure()
    {
    }

    public function __construct(DocumentManager $documentManager, LoggerInterface $logger)
    {
        parent::__construct();
        $this->documentManager = $documentManager;
        $this->logger = $logger;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = Client::createChromeClient();
        $ads = 1;
        $pages = 1;
        for ($i = 0; $i <= 100; $i++) {
            try {
                $crawler = $client->request('GET', 'https://www.avito.ma/fr/maroc/voitures-à_vendre?o=' . $i);
            } catch (WebDriverCurlException $e) {
                continue;
            } catch (\Exception $e) {
                continue;
            }

            $nodeValues = $crawler->filter('h2[class=fs14]')->each(function (Crawler $node, $i) {
                return $node->children('a')->attr('href');
            });

            foreach ($nodeValues as $key => $link) {
                try {
                    $crawler = $client->request('GET', $link);
                } catch (WebDriverCurlException $e) {
                    continue;
                } catch (\Exception $e) {
                    continue;
                }

                $car = new Car();
                $title = null;
                $price = null;
                $modelYear = null;
                $mileageMin = null;
                $mileageMax = null;
                $fuelType = null;
                $mark = null;
                $model = null;
                $fiscalPower = null;
                $city = null;
                $postedAt = null;
                $views = null;
                $images = [];

                if ($crawler->filter('h1')->count() > 0) {
                    $title = $crawler->filter('h1')->text();
                }

                if ($crawler->filter('.vi-price-label.text-center.fs18.no-margin .amount.value')->count() > 0) {
                    $price = (float)$crawler->filter('.vi-price-label.text-center.fs18.no-margin .amount.value')->attr('title');
                }

                if ($crawler->filter('.span8 aside ul li:nth-child(1) h2 a')->count() > 0) {
                    $modelYear = (int)$crawler->filter('.span8 aside ul li:nth-child(1) h2 a')->text();
                }

                if ($crawler->filter('.span8 aside ul li:nth-child(2) h2')->count() > 0) {
                    $mileage = explode('-', str_replace(' ', '', str_replace('Kilométrage: ', '', $crawler->filter('.span8 aside ul li:nth-child(2) h2')->text())));
                    if (count($mileage) > 0) {
                        $mileageMin = isset($mileage[0]) ? (int)$mileage[0] : 0;
                        $mileageMax = isset($mileage[1]) ? (int)$mileage[1] : 0;
                    }
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
                    $fiscalPower = (int)str_replace(' CV', '', $crawler->filter('.span8 aside ul li:nth-child(6) h2 a')->text());
                }

                if ($crawler->filter('.font-normal.fs13.lh30.no-margin')->count() > 0) {
                    $city = $crawler->filter('.font-normal.fs13.lh30.no-margin')->text();
                }

                if ($crawler->filter('.date.dtstart.value')->count() > 0) {
                    $postedAt = date('Y-m-d H:i:s', strtotime(
                        str_replace('T', ' ', $crawler->filter('.date.dtstart.value')->attr('title'))
                    ));
                }

                if ($crawler->filter('.span20')->first()->filter('.panel')->first()->filter('span')->count() > 0) {
                    $views = (int)str_replace(
                        ' total',
                        '',
                        str_replace('Vues: ', '', $crawler->filter('.span20')->first()->filter('.panel')->first()->filter('span')->text())
                    );
                }
                if ($crawler->filter('#myCarousel ol li')->count() > 0) {
                    $images = $crawler->filter('#myCarousel ol li')->each(function (Crawler $node, $i) {
                        return $node->children('img')->attr('src');
                    });
                }

                if ($price !== null && count($images) > 0) {
                    $car->setTitle($title);
                    $car->setPrice($price);
                    $car->setModelYear($modelYear);
                    $car->setMileageMin($mileageMin);
                    $car->setMileageMax($mileageMax);
                    $car->setFuelType($fuelType);
                    $car->setMark($mark);
                    $car->setModel($model);
                    $car->setFiscalPower($fiscalPower);
                    $car->setCity($city);
                    $car->setPostedAt($postedAt);
                    $car->setViews($views);
                    $car->setLink($link);
                    $car->setImages($images);

                    $this->documentManager->persist($car);
                    $this->documentManager->flush();

                    dump($car);
                    $output->writeln(date('d-m-Y H:m:s').' << Annonce N° : ' . $ads . ' | Page N° : ' . $pages . ' >>');
                    $this->logger->notice(date('d-m-Y H:m:s').' << Annonce N° : ' . $ads . ' | Page N° : ' . $pages . ' >>');

                    $ads++;

                } else {
                    $output->writeln('<< Annonce Non Valide >>');
                }
            }
            $pages++;
        }
        $output->writeln('End');
    }
}
