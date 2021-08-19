<?php

namespace App\GraphQL\Resolver;

use App\Product\Provider;
use App\Entity\Categories;
use GraphQL\Type\Definition\ResolveInfo;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Relay\Connection\Paginator;
use Overblog\GraphQLBundle\Relay\Connection\Output\Connection;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

Class CategoriesResolver implements ResolverInterface
{
    private EntityManagerInterface $manager;
    private Provider $productProvider;
    
    public function __construct(EntityManagerInterface $manager, Provider $provider)
    {
        $this->manager = $manager;
        $this->productProvider = $provider;
    }

    public function __invoke(ResolveInfo $info, $value, Argument $args)
    {
        $method = $info->fieldName;

        return $this->$method($value, $args);
    }

    public function resolve(int $id) : Categories
    {
        return $this->manager
            ->getRepository(Categories::class)
            ->find($id);
    }

    public function name(Categories $category) :string
    {
        return $category->getName();
    }

    public function description(Categories $category) :string
    {
        return $category->getDescription();
    }

    public function products(Categories $category, Argument $args) : Connection
    {
        $paginator = new Paginator(function ($offset, $limit) use ($category) {
            return $this->productProvider
                ->getProductsByCategory($category->getId(),$offset , $limit);
        });
        
        return $paginator->auto($args, function() use ($category) {
            return $this->productProvider
                ->countProductsByCategory($category->getId());
        });
    }
}