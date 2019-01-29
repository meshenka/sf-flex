<?php
namespace App\Domain\ResponseCreator;

use App\Domain\Response\Product\GetProductResponse;
use App\Domain\UseCase\UseCaseResponse;
use App\Domain\Model\Product;

/**
 * 
 * similar to Redux action creator
 */
class ProductResponseCreator {

    public function createGetProduct(Product $product) : UseCaseResponse 
    {
        return new GetProductResponse($product);
    } 
}