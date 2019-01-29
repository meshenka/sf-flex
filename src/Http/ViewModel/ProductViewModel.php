<?php

namespace App\Http\ViewModel;
use App\Domain\Model\Product;

class ProductViewModel extends Product {

    public function __construct(Product $product) 
    {
        $this->id = $product->getId();
        $this->price = $product->getPrice();
        $this->name = $product->getName();
        $this->description = $product->getDescription();
    }
}