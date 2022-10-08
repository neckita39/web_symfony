<?php

namespace App\DataFixtures;

use App\Entity\Quote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class QuoteFixture extends Fixture
{
	public const QUOTE_COUNT = 50;
	public const QUOTE_WORDS_COUNT = 10;
	private Generator $faker;

	public function __construct()
	{
		$this->faker = Factory::create();
	}
    public function load(ObjectManager $manager): void
    {
		$this->generateQuotes($manager);
    }

	private function generateQuotes(ObjectManager $manager): void
	{
		for ($i = 0; $i < static::QUOTE_COUNT; ++$i)
		{
			$manager->persist($this->generateQuote());
		}
		$manager->flush();
	}

	private function generateQuote(): Quote
	{
		return new Quote(
			$this->faker->sentence(static::QUOTE_WORDS_COUNT),
			$this->faker->name(),
			$this->faker->year()
		);
	}
}
