<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AuthorFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $author = new Author();
            $author->setNom($faker->name);
            $author->setEmail($faker->email);
            $author->setPicture($faker->imageUrl(400, 400, 'people')); 
            $author->setNbBooks($faker->numberBetween(1, 50));  

            // Persist the author entity to the database
            $manager->persist($author);
        }

        // Write all the authors to the database
        $manager->flush();
    }
}
