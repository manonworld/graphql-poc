<?php

namespace App\GraphQL\Mutation;

use OverBlog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Products;
use App\Repository\CategoriesRepository;

class ProductsMutation implements AliasedInterface, MutationInterface
{

    private EntityManagerInterface $em;
    private CategoriesRepository $catRepo;

    public function __construct(
        EntityManagerInterface $em, 
        CategoriesRepository $catRepo
    ){
        $this->em       = $em;
        $this->catRepo  = $catRepo;
    }

    public function createProducts(Argument $args)
    {
        $input = $args['input'];

        $category = $this->catRepo->find($input['category']);

        $product = new Products;
        $product->setName($input['name'])
            ->setPrice($input['price'])
            ->setDescription($input['description'])
            ->setCategory($category);
        
        $this->em->persist($product);
        $this->em->flush();

        return $product;
    }

    public static function getAliases(): array
    {
        return [
            'createProducts' => 'create_products'
        ];
    }

}