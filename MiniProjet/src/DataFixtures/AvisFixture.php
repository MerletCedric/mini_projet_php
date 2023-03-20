<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Avis;

class AvisFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $avis1 = new Avis;
        $avis1->setNote(4)
        ->setCommentaire(
            "Je dois dire que j'ai été très satisfait de mon expérience. Le conducteur était très sympathique et professionnel, il a communiqué avec moi avant le trajet pour s'assurer que tout était clair et que je savais où nous devions nous rencontrer.
            Le trajet s'est déroulé sans encombre, la voiture était propre et confortable, et le conducteur a respecté toutes les règles de conduite. Nous sommes arrivés à destination à l'heure prévue et j'ai été très reconnaissant de ne pas avoir à prendre les transports en commun.        
            Je recommande fortement ce conducteur pour tous ceux qui cherchent un trajet en covoiturage fiable et agréable. Merci encore pour cette expérience de voyage agréable et sans stress !"
        )
        ->setTrajets($manager->merge($this->getReference('trajet1')))
        ->setUsers($manager->merge($this->getReference('user2')));
        $manager->persist($avis1);
       
        $avis2 = new Avis;
        $avis2->setNote(1)
        ->setCommentaire(
            "Je ne recommande pas ce conducteur pour un trajet de covoiturage. Le trajet a été très inconfortable et je me suis senti en danger pendant tout le trajet. Le conducteur conduisait très vite et faisait des dépassements dangereux. De plus, la voiture était très sale et sentait mauvais."
        )
        ->setTrajets($manager->merge($this->getReference('trajet3')))
        ->setUsers($manager->merge($this->getReference('user5')));
        $manager->persist($avis2);

        $avis3 = new Avis;
        $avis3->setNote(5)
        ->setCommentaire(
           "Parfait ! ")
        ->setTrajets($manager->merge($this->getReference('trajet1')))
        ->setUsers($manager->merge($this->getReference('user3')));
        $manager->persist($avis3);

        $avis4 = new Avis;
        $avis4->setNote(5)
        ->setCommentaire(
           "Super trajet, arrivé dans les temps")
        ->setTrajets($manager->merge($this->getReference('trajet3')))
        ->setUsers($manager->merge($this->getReference('user3')));
        $manager->persist($avis4);

        $avis5 = new Avis;
        $avis5->setNote(5)
        ->setCommentaire("")
        ->setTrajets($manager->merge($this->getReference('trajet2')))
        ->setUsers($manager->merge($this->getReference('user1')));
        $manager->persist($avis5);

        $avis6 = new Avis;
        $avis6->setNote(2)
        ->setCommentaire("")
        ->setTrajets($manager->merge($this->getReference('trajet3')))
        ->setUsers($manager->merge($this->getReference('user2')));
        $manager->persist($avis6);
        
        $manager->flush();
    }
     /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            TrajetFixture::class,
            UserFixture::class,
        ];
    }
}
