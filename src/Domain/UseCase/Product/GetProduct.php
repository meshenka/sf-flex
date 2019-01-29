<?php

namespace App\Domain\UseCase\Product;

use App\Domain\Store\ProductStoreInterface;
use App\Domain\UseCase\UseCase;
use App\Domain\UseCase\UseCaseRequest;
use App\Domain\UseCase\UseCaseResponse;

use App\Domain\ResponseCreator\ProductResponseCreator;

/**
 * this is a command pattern
 * the UseCase is the Command
 * the Store act as a Control
 * UseCaseRequest is command parameters
 * executre returns UseCaseResponse 
 */

class GetProduct implements UseCase {

    /**
     * @var ProductStoreInterface
     */
    protected $store;

    /**
     * @var ProductResponseCreator
     */
    protected $responseCreator;

    public function __construct(ProductStoreInterface $store, ProductResponseCreator $responseCreator ) 
    {

        $this->store = $store;
        $this->responseCreator = $responseCreator;
    }

    public function execute( UseCaseRequest $request): UseCaseResponse
    {
        //extract id from the request
        $productId = $request->getId();
        
        //get the product from the control
        $product = $this->store->find($productId);

        //create a GetProductResponse
        $response = $this->responseCreator->createGetProduct($product);

        return $response; 
    }
}
