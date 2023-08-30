<?php

namespace App\DataFixtures;

use App\Factory\VinyMixFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

//composer require --dev orm-fixtures 
//php bin/console doctrine:fixtures:load it clears our database, calls that blank method, and... the result over on the "Browse" page is that we have nothing!
//   It empties the database, executes our fixtures, and we have... one new mix!
/*$mix=new VinyMix();
        $mix->setTitle('Do you remember... Phil Collins?!');
        $mix->setDescription('A pure mix of drumers turned singers!');
        $mix->setTrackCount(rand(5,20));
        $mix->setVotes(rand(-50,50));
       $genres=['pop','rock','Heavy metal'];
        $mix->setGenre($genres[array_rand($genres)]);
        $manager->persist($mix);
        $manager->flush();

         We have a new bin/console command to load stuff. But for developing, I want a really rich set of data fixtures, like... maybe 25 mixes. We could add those by hand here... or even create a loop. But there's a better way, via a library called "Foundry".
        */

        //composer require zenstruck/foundry --dev
        //In short, Foundry helps us create entity objects. It's... almost easier just to see it in action. First, for each entity in your project (right now, we only have one), you'll need a corresponding factory class. Create that by running
        //Factories: make:factory:php bin/console make:factory We'll generate one for VinylMix. And... that created a single file: VinylMixFactory.php. Let's go check it out: src/Factory/VinylMixFactory.php.
        /*
        Fake Data with Faker
To generate interesting data, Foundry leverages another library called "Faker", whose only job is to... create fake data. So if you want some fake text, you can say self::faker()->, followed by whatever you want to generate. There are many different methods you can call on faker() to get all kinds of fun fake data. Super handy!
Creating Many Objects
Our factory did a pretty good job... but let's customize things to make it a bit more realistic. Actually, first, having one VinylMix still isn't very useful. So instead, inside AppFixtures, change this to createMany(25).
& then run symfony console doctrine:fixtures:load


*/
      VinyMixFactory::createMany(50);
    }
}