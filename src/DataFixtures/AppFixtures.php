<?php

namespace App\DataFixtures;

use App\Entity\Developpeur;
use App\Entity\Langage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{


    private $userPasswordHasherInterface;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager)
    {
        $angular = (new Langage())
            ->setNom("Angular")
            ->setImage("angular.png");
        $manager->persist($angular);
        $react = (new Langage())
            ->setNom("React")
            ->setImage("react.png");
        $manager->persist($react);
        $callj = (new Developpeur())
            ->setRoles(["ROLE_ADMIN", "ROLE_USER"])
            ->setEmail("caliendo@hotmail.fr")
            ->setPseudo("CallJ")
            ->addLangage($angular);
        $callj->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $callj,
                "enieni"
            )
        );
        $manager->persist($callj);
        $bob = (new Developpeur())
            ->setRoles(["ROLE_USER"])
            ->setEmail("bob@hotmail.fr")
            ->setPseudo("Bob")
            ->addLangage($angular)
            ->addLangage($react);
        $bob->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $bob,
                "enieni"
            )
        );
        $manager->persist($bob);
        $marcel = (new Developpeur())
            ->setRoles(["ROLE_USER"])
            ->setEmail("marcel@hotmail.fr")
            ->setPseudo("Marcel")
            ->addLangage($angular);
        $marcel->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $marcel,
                "enieni"
            )
        );
        $manager->persist($marcel);
        $manager->flush();
    }
}
