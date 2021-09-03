<?php

namespace App\GraphQL\Mutation;

use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use App\Entity\Grade;

final class GradeMutation implements MutationInterface, AliasedInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function resolve(string $name)
    {
        $grade = new Grade;
        $grade->setName($name);

        $this->em->persist($grade);
        $this->em->flush();

        return ['content' => 'created'];
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'NewGrade',
        ];
    }
}