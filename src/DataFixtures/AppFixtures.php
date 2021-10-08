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
        $svelte = (new Langage())
            ->setNom("Svelte")
            ->setImage("svelte.png");
        $manager->persist($svelte);
        $spring = (new Langage())
            ->setNom("Spring")
            ->setImage("spring.png");
        $manager->persist($spring);
        $vue = (new Langage())
            ->setNom("Vue")
            ->setImage("vue.png");
        $manager->persist($vue);
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
            ->addLangage($spring)
            ->addLangage($svelte);
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
            ->addLangage($angular)
            ->addLangage($vue);
        $marcel->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $marcel,
                "enieni"
            )
        );
        $manager->persist($marcel);
        $manager->flush();

        $manager->flush();
    }
}
