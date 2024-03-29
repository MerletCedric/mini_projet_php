<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setNom("MERLET")
        ->setPrenom("Cédric")
        ->setEmail("cedricmerlet@gmail.com")
        ->setPassword($this->passwordEncoder->encodePassword(
            $user1, 'admin_cedric'
        ))
        ->setRoles(["ROLE_ADMIN","ROLE_USER"]);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setNom("TANCRAY")
        ->setPrenom("Manon")
        ->setEmail("manontancray@gmail.com")
        ->setPassword($this->passwordEncoder->encodePassword(
            $user2, 'admin_manon'))
        ->setRoles(["ROLE_ADMIN","ROLE_USER"]);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setNom("MIROIT")
        ->setPrenom("Robert")
        ->setEmail("robertmiroit@gmail.com")
        ->setPassword($this->passwordEncoder->encodePassword(
            $user3, 'roro19'))
        ->setRoles(["ROLE_USER"]);
        $manager->persist($user3);

        $user4 = new User();
        $user4->setNom("COUET")
        ->setPrenom("Patricia")
        ->setEmail("patriciatcouet@gmail.com")
        ->setPassword($this->passwordEncoder->encodePassword(
            $user4, 'patou_patou'))
        ->setRoles(["ROLE_USER"]);
        $manager->persist($user4);

        $user5 = new User();
        $user5->setNom("CARDE")
        ->setPrenom("Paulette")
        ->setEmail("paulettecarde@gmail.com")
        ->setPassword($this->passwordEncoder->encodePassword(
            $user5, '555555'))
        ->setRoles(["ROLE_USER"]);
        $manager->persist($user5);

        $manager->flush();

        $this->addReference("user1", $user1);
        $this->addReference("user2", $user2);
        $this->addReference("user3", $user3);
        $this->addReference("user4", $user4);
        $this->addReference("user5", $user5);
    }
}
