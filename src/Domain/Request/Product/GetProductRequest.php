<?php

namespace App\Domain\Request\Product;

use App\Domain\UseCase\UseCaseRequest;

/**
 * immutable
 */
class GetProductRequest implements UseCaseRequest {

    /**
     * @var int
     */
    private $id;

    public function __construct($id) 
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}