<?php

namespace spec\App\Http\Assembly;

use App\Http\Assembly\ProductAssembly;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Domain\Store\ProductStoreInterface;
use App\Http\ViewModel\ProductViewModel;
use App\Store\Entity\ProductEntity;

class ProductAssemblySpec extends ObjectBehavior
{
    /** @var ProductStoreInterface */
    private $store;

    public function let(ProductStoreInterface $store) 
    {
        $this->store = $store;

        $this->beConstructedWith($store);
        
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ProductAssembly::class);
    }

    public function it_convert_product_to_viewmodel()
    {
        $product  = new ProductEntity();
        $product
            ->setId(99)
            ->setName("phpspec")
            ->setPrice(99.10)
            ->setDescription("unit testing");

        $result = $this->entityToViewModel($product);
        $result->shouldHaveType(ProductViewModel::class);
        $result->getId()->shouldBe(99);
        $result->getName()->shouldBe("phpspec");
        $result->getPrice()->shouldBe(99.10);
        $result->getDescription()->shouldBe("unit testing");
        
        
    }
}
