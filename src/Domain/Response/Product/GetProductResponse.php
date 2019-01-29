<?php

namespace App\Domain\Response\Product;

use App\Domain\UseCase\UseCaseResponse;
use App\Domain\Model\Product;


/**
 * immutable
 */
class GetProductResponse implements UseCaseResponse {

    /**
     * @var Product
     */
    private $product;

    public function __construct(Product $product) 
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}