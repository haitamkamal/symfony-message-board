<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1 -> setName ("ali");
        $product1 -> setDescription("This product was manually added.");
        $product1 -> setSize(150);

        $manager->persist($product1);

        $product2 = new product();
        $product2 -> setName("sara");
        $product2 -> setDescription("this is the second manually added product.");
        $product2 -> setSize(200);

        $manager->persist($product2);

        $manager->flush();
    }
}
