<?php declare(strict_types=1);

namespace App\Product;

use App\Repository\ProductsRepository;
use App\Entity\Products;

class Provider
{
    private ProductsRepository $repo;

    public function __construct( ProductsRepository $repo ) 
    {
        $this->repo = $repo;
    }
    
    public function getProductsByCategory(int $id, int $skip, int $limit): array
    {
        $productData = $this->repo->findByCats($id, $skip, $limit);
        
        $product = [];
        foreach($productData as $data) {
            $product[] = [
                'id' => $data->getId(),
                'category' => $data->getCategory(),
                'name' => $data->getName(),
                'description' => $data->getDescription(),
                'price' => $data->getPrice()
            ];
        }

        return $product;
    }
    
    public function countProductsByCategory(int $id): int
    {
        return $this->repo->findByCatsCount($id);
    }
}