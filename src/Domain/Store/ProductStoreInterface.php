<?php

namespace App\Domain\Store;

use App\Domain\Model\Product;

/**
 * Doctrine Repository should implement this interface
 */
interface ProductStoreInterface {

    public function find($id);

    public function update(Product $product);
    
}