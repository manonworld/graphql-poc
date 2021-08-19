<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Products;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 20; $i++) {
            $product = new Products;
            $product->setName('testProduct' . $i);
            $product->setDescription('testProductDescription' . $i);
            $product->setCategory($this->getReference('categoryName1'));
            $product->setPrice(floatval('1.' . $i));
            $manager->persist($product);
        }
        $manager->flush();
    }
}
