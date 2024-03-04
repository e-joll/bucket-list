<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const TRAVEL_ADVENTURE_CATEGORY_REFERENCE = 'category_travel_and_adventure';
    public const SPORTS_CATEGORY_REFERENCE = 'category_sports';
    public const ENTERTAINMENT_CATEGORY_REFERENCE = 'category_entertainment';
    public const HUMAN_RELATIONS_CATEGORY_REFERENCE = 'category_human_relations';
    public const OTHERS_CATEGORY_REFERENCE = 'category_others';

    public function load(ObjectManager $manager): void
    {
        $travelAndAdventure = new Category();
        $travelAndAdventure->setName('Voyages et aventures');
        $manager->persist($travelAndAdventure);
        $this->addReference(self::TRAVEL_ADVENTURE_CATEGORY_REFERENCE, $travelAndAdventure);

        $sports = new Category();
        $sports->setName('Sports');
        $manager->persist($sports);
        $this->addReference(self::SPORTS_CATEGORY_REFERENCE, $sports);

        $entertainment = new Category();
        $entertainment->setName('Loisirs');
        $manager->persist($entertainment);
        $this->addReference(self::ENTERTAINMENT_CATEGORY_REFERENCE, $entertainment);

        $humanRelations = new Category();
        $humanRelations->setName('Relations humaines');
        $manager->persist($humanRelations);
        $this->addReference(self::HUMAN_RELATIONS_CATEGORY_REFERENCE, $humanRelations);

        $others = new Category();
        $others->setName('Autres');
        $manager->persist($others);
        $this->addReference(self::OTHERS_CATEGORY_REFERENCE, $others);

        $manager->flush();
    }
}
