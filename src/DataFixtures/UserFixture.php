<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class UserFixture extends Fixture
{
	private Generator $faker;

	public function __construct()
	{
		$this->faker = Factory::create();
	}

    public function load(ObjectManager $manager): void
    {
        $manager->persist($this->generateAdmin());
        $manager->persist($this->generateUser());

        $manager->flush();
    }

	public function generateAdmin(): User
	{
		return new User(
			$this->faker->userName(),
			['ROLE_ADMIN'],
			$this->faker->password(),
		);
	}

	public function generateUser(): User
	{
		return new User(
			$this->faker->userName(),
			['ROLE_USER'],
			$this->faker->password()
		);
	}
}
