<?php

namespace App\Controller;
use App\Entity\VinyMix;
use App\Repository\VinyMixRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class MixController extends AbstractController
{
    #[Route('/mix/new')]
public function new(EntityManagerInterface $entityManager):Response{
        $mix=new VinyMix();
        $mix->setTitle('Do you remember... Phil Collins?!');
        $mix->setDescription('A pure mix of drumers turned singers!');
        $mix->setTrackCount(rand(5,20));
        $mix->setVotes(rand(-50,50));
       $genres=['pop','rock','Heavy metal'];
        $mix->setGenre($genres[array_rand($genres)]);
        $entityManager->persist($mix);
        $entityManager->flush();
        // persist() and then flush(). The reason it's split into two methods is to help with patch data loading... where you could persist a hundred $mix objects then flush them to the database all at once, which is more efficient. But most of the time, you'll call persist() and then flush().
        return new Response(sprintf('mix %d is %d of pure 80\'s heaven',$mix->getId(), $mix->getTrackCount()));
    }


    #[Route('/mix/{slug}',name:'app_mix_show')]
    public function show(VinyMix $mix){
       // $mix=$mixRep->findOneBySomeField($id);or
       //$mix=$mixRep->find($id);
      //if(!$mix){
        //throw $this->createNotFoundException('Mix not found');
       //}
//instead we just use the @ParamConverter offred by composer require sensio/framework-extra-bundle it converts the id in the slug to the mix->id VinyMix $mix and when we don't hav a mix with the entred id we get 404error  App\Entity\VinyMix object not found by the @ParamConverter annotation. 
       return  $this->render('mix/show.html.twig', [
        'mix' => $mix,
    ]);

    }

    #[Route('/mix/{id}/vote',name:'app_mix_vote',methods:['POST'])]
    public function vote(VinyMix $mix,Request $request,EntityManagerInterface $entityManager){
        //direction default to 'up'
        $direction=$request->request->get('direction','up');
        if($direction==='up'){
            $mix->upVote();
        }
        else 
        $mix->downVote();
        //$entityManager->persist($mix); . But when you're updating an entity, it means that you've already asked Doctrine to query for that object. So Doctrine is already aware of it... and when we call flush(), Doctrine will - automatically - check that object to see if any changes have been made to it. we only need to flush()
        $entityManager->flush();
        //Flash messages have a fancy name, but they're a simple idea; Symfony stores flash messages in the user's session. What makes them special is that Symfony will remove the message automatically as soon as we read it. They're like self-destructing messages. Pretty cool.
        $this->addFlash('success','vote counted');
        return $this->redirectToRoute('app_mix_show', [
            'slug' => $mix->getSlug(),
        ]); 
    }
}
