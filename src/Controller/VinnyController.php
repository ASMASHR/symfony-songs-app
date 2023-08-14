<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    #[Route('/browse/{slug}',name:'app_browse')]
    public function browse(string $slug=null):Response{
        //$slug=null  to prevent the error of /browse/ return no such url
        //u() symfony library return an object exemple we need to uppercase title john-dow==> John Dow
        if($slug===null){
          $title='All Genres';
        }
        else {
            $title = 'Genre: ' . u(str_replace('-', ' ', $slug))->title(true);
        }
$genre=$slug? u(str_replace('-', ' ', $slug))->title(true):null;
        return  $this->render(
            ('Vinny/browse.html.twig'),['genre'=>$genre]);
    }

}
