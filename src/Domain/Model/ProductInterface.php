<?php

namespace App\Domain\Model;

interface  ProductInterface {

    public function getName() : string;
    public function getId() : int;
    public function getDescription() : string;
    public function getPrice(): float;

}