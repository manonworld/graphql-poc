<?php

namespace App\GraphQL\Mutation;

use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use App\Entity\Astronaut;
use App\Repository\GradeRepository;

final class AstronautMutation implements MutationInterface, AliasedInterface
{
    private $em;
    private $gradeRepo;

    public function __construct(EntityManagerInterface $em, GradeRepository $gradeRepo)
    {
        $this->em           = $em;
        $this->gradeRepo    = $gradeRepo;
    }

    public function resolve(string $pseudo, int $grade)
    {
        $astronaute = new Astronaut;
        $astronaute->setPseudo($pseudo);

        $grade = $this->gradeRepo->find($grade);
        $astronaute->setGrade($grade);

        $this->em->persist($astronaute);
        $this->em->flush();

        return ['content' => 'created'];
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'NewAstronaut',
        ];
    }
}