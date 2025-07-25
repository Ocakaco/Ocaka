<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Carbon\CarbonImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Posts;
use App\Entity\User;
use App\Entity\Category;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\CategoryFixtures;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
		for ($i = 0; $i < 33; $i++) {
			$post = new Posts();
			$post->setTitle('Lorem Ipsum ' . $i);
			$post->setCreatedAt(CarbonImmutable::now());
			$post->setContent('Lorem Ipsum Dolor Sit Amet...');
			$post->setAuthor($this->getReference(UserFixtures::ADMIN_USER_REFERENCE, User::class));
			$post->setCategory($this->getReference(CategoryFixtures::FIKSI_CATEGORY_REFERENCE, Category::class));

			$manager->persist($post);
		}

        $manager->flush();
    }

	public function getDependencies(): array
	{
		return [
			UserFixtures::class,
			CategoryFixtures::class
		];
	}
}
