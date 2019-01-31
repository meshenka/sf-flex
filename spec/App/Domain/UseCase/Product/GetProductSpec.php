<?php

namespace spec\App\Domain\UseCase\Product;

use App\Domain\UseCase\Product\GetProduct;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Domain\Store\ProductStoreInterface;
use App\Domain\Model\Product;
use App\Domain\ResponseCreator\ProductResponseCreator;
use App\Domain\RequestCreator\ProductRequestCreator;
use App\Domain\Response\Product\GetProductResponse;


class GetProductSpec extends ObjectBehavior
{
    const FAKE_ID = 55;

    public $store;
    public $creator;


    public function let(ProductStoreInterface $store) {
        $this->store = $store;
        $this->creator = new ProductResponseCreator();

        $this->beConstructedWith($store, $this->creator);
        
    }

    public  function it_is_initializable()
    {
        
        $this->shouldHaveType(GetProduct::class);
    }

    public function it_execute(Product $p) {
        $request = (new  ProductRequestCreator())->createGetProduct(self::FAKE_ID);

        $this->store->find(self::FAKE_ID)->willReturn($p);

        $response = $this->execute($request);
        $response->shouldHaveType(GetProductResponse::class);
        $response->getProduct()->shouldBe($p);
    }

}
