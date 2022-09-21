<?php

namespace App\Tests\Entity;

use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CategoryEntityTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->validator = $kernel->getContainer()->get('validator');

    }

    public function testUserEntityIsValid(): void
    {

        $categorie = new Categorie();

        $categorie
            ->setName("Politique");

        $this->getValidationErrors($categorie, 0);
    }

    public function getValidationErrors(Categorie $categorie, int $numberOfExpectedErrors): ConstraintViolationList
    {
        $errors = $this->validator->validate($categorie);

        $this->assertCount($numberOfExpectedErrors, $errors);

        return $errors;
    }
}