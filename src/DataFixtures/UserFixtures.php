<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
	public const ADMIN_USER_REFERENCE = 'admin';

    public function load(ObjectManager $manager): void
    {
		$user = new User();
		$user->setUsername('admin');
		$user->setEmail('admin@ocaka.co.id');
		$user->setPassword('admin');
		$user->setRole('admin');

		$manager->persist($user);

        $manager->flush();

		$this->addReference(self::ADMIN_USER_REFERENCE, $user);
    }
}
