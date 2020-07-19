<?php

namespace App\Console\Commands;

use App\Passer;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class CrawlNCE extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:nce';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl 2019 PSHS NCE Passers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => 'http://www.pshs.edu.ph'
        ]);

        $response = $client->request('get', '/nce2019', [
            "headers" => [
                "Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
                "Accept-Encoding" => "gzip, deflate",
                "User-Agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36"
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $html = $response->getBody()->getContents();

            $crawler = new Crawler($html);

            $crawler->filter('div.container_list > div')->each(function ($node) {
                $row = $node->children();

                if ($row->count() == 5) {
                    $data = [
                        'name' => $row->getNode(1)->nodeValue,
                        'campus' => $row->getNode(2)->nodeValue,
                        'school' => $row->getNode(3)->nodeValue,
                        'division' => $row->getNode(4)->nodeValue
                    ];
                    Passer::firstOrCreate($data);
                }
            });
        }
    }
}
