<?php

namespace App\Controller;

use App\Service\MixesService;
use Psr\Cache\CacheItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use  Symfony\Contracts\Cache\CacheInterface;
use function Symfony\Component\String\u;

class VinnyController extends AbstractController
{
    #[Route('/',name:'app_home')]
    public function home():Response{
        $tracks=[
            ['song'=>'Gangsta\'s Paradise','artist'=>'Coolio'],
            ['song'=>'Waterfalls','artist'=>'TLC'],
            ['song'=>'Creep','artist'=>'TLC'],
            ['song'=>'Kiss from a Rose','artist'=>'Seal'],
            ['song'=>'On Bended Knee','artist'=>'Boyz II Men'],
            ['song'=>'Another Night','artist'=>'Real McCoy'],
            ['song'=>'Fantasy','artist'=>'Mariah Carey'],
            ['song'=>'Take a Bow','artist'=>'Madonna']
        ];
        return $this->render(
        ('Vinny/home.html.twig'),
        ['title'=>' new symfony site',
           'tracks'=> $tracks]);
    }

    #[Route('/browse/{slug}', name: 'app_browse')]
    public function browse(HttpClientInterface $httpClient, CacheInterface $cache, MixesService $mixesService, string $slug = null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        $mixes =$mixesService->getAll();



        return $this->render('Vinny/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
    private function getMixes(): array
    {
        // temporary fake "mixes" data
        return [
            [
                'title' => 'PB & Jams',
                'trackCount' => 14,
                'genre' => 'Rock',
                'createdAt' => new \DateTime('2021-10-02'),
            ],
            [
                'title' => 'Put a Hex on your Ex',
                'trackCount' => 8,
                'genre' => 'Heavy Metal',
                'createdAt' => new \DateTime('2022-04-28'),
            ],
            [
                'title' => 'Spice Grills - Summer Tunes',
                'trackCount' => 10,
                'genre' => 'Pop',
                'createdAt' => new \DateTime('2019-06-20'),
            ],
        ];
    }

}
