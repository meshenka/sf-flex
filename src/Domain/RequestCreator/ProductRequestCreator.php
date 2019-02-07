<?php
namespace App\Domain\RequestCreator;

use App\Domain\Request\Product\GetProductRequest;
use App\Domain\UseCase\UseCaseRequest;

/**
 * 
 * similar to Redux action creator
 */
class ProductRequestCreator {

    public function createGetProduct(int $id) : UseCaseRequest 
    {
        return new GetProductRequest($id);
    } 
}