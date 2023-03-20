<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ville;

class VilleFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ville1 = new Ville();
        $ville1->setNom('Damgan')
        ->setCodePostal('56750');
        $manager->persist($ville1);
    
        $ville2 = new Ville();
        $ville2->setNom('Geneston')
        ->setCodePostal('44140');
        $manager->persist($ville2);

        $ville3 = new Ville();
        $ville3->setNom('Caen')
        ->setCodePostal('14000');
        $manager->persist($ville3);

        $ville4 = new Ville();
        $ville4->setNom('Toulouse')
        ->setCodePostal('31000');
        $manager->persist($ville4);
    
        $ville5 = new Ville();
        $ville5->setNom('Rennes')
        ->setCodePostal('35000');
        $manager->persist($ville5);
    
        $ville6 = new Ville();
        $ville6->setNom('Brest')
        ->setCodePostal('29000');
        $manager->persist($ville6);
    
        $ville7 = new Ville();
        $ville7->setNom('Tours')
        ->setCodePostal('37000');
        $manager->persist($ville7);
    
        $manager->flush();

        $this->addReference('ville1', $ville1);
        $this->addReference('ville2', $ville2);
        $this->addReference('ville3', $ville3);
        $this->addReference('ville4', $ville4);
        $this->addReference('ville5', $ville5);
        $this->addReference('ville6', $ville6);
        $this->addReference('ville7', $ville7);
    }
}
