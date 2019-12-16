<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('rowan.amatkario@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstname('Rowan');
        $user->setLastname('Amatkario');
        $user->setPassword($this->passwordEncoder->encodePassword (
            $user,
            'WelcomeNewMember'
        ));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('jan.hogeboom@gmail.com');
        $user->setRoles(['ROLE_INSTRUCTOR']);
        $user->setFirstname('Jan');
        $user->setLastname('Hogeboom');
        $user->setPassword($this->passwordEncoder->encodePassword (
            $user,
            'WelcomeNewMember'
        ));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('vito.jeffrey@gmail.com');
        $user->setRoles(['ROLE_USER']);
        $user->setFirstname('Vito');
        $user->setLastname('en Jeffrey');
        $user->setPassword($this->passwordEncoder->encodePassword (
            $user,
            'WelcomeNewMember'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
