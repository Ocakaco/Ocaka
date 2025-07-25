<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
	public const FIKSI_CATEGORY_REFERENCE = 'fiksi';
    public function load(ObjectManager $manager): void
    {
		$categoryNames = array('Fiksi', 'Artikel', 'How-to');

		for ($i = 0; $i < 3; $i++) {
			$categories[$i] = new Category();
			$categories[$i]->setName($categoryNames[$i]);

			$manager->persist($categories[$i]);
		}

        $manager->flush();

		$this->addReference(self::FIKSI_CATEGORY_REFERENCE, $categories[0]);
    }
}
