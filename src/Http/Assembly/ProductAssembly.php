<?php

namespace App\Http\Assembly;

use App\Store\Entity\ProductEntity;
use App\Http\ViewModel\ProductViewModel;
use App\Domain\Store\ProductStoreInterface;

/**
 * Assembly convert Entity <=> ViewModel
 */
class ProductAssembly {

    /**
     * @var ProductStoreInterface
     */
    private $store;

    public function __construct(ProductStoreInterface $store)
    {
        $this->store = $store;
    }

    public function entityToViewModel(ProductEntity $product): ProductViewModel 
    {
        return new ProductViewModel($product);
    }

    public function viewModelToEntity(ProductViewModel $viewModel): ProductEntity
    {
        return $this->store->find($viewModel->getId());
    }
}