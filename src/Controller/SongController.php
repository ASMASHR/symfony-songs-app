<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
    //id<\d+> match only int in the url to avoid 500 error page when selecting string instead of an interror= arg $id must be of type int
    //->so the error become 404 no rout found
    #[Route('/api/songs/{id<\d+>}',methods: ['GET'],name: 'api_songs_get_one')]
    public function getSong(int $id, LoggerInterface $logger):Response{
        $song=[
          'id'=>$id,
          'name'=>'Waterfalls' ,
          'url'=> 'https://symfonycasts.s3.amazonaws.com/sample.mp3',
        ];
        $logger->info('this is info logger for song {song}',['song'=>$song['name']]);
        return new JsonResponse($song);
    }

}
