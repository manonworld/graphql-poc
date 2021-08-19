<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categories;

class CategoriesFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Categories;
        $category->setName('categoryName1');
        $category->setDescription('categoryDescription1');
        $manager->persist($category);
        $manager->flush();
        $this->addReference('categoryName1', $category);
    }
}
