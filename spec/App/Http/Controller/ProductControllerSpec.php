<?php

namespace spec\App\Http\Controller;

use App\Http\Controller\ProductController;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Domain\RequestCreator\ProductRequestCreator;
use App\Domain\UseCase\Product\GetProduct;
use App\Http\ViewModel\ProductViewModel;
use App\Http\Assembly\ProductAssembly;


class ProductControllerSpec extends ObjectBehavior
{
    /** @var ProductRequestCreator */
    private $requestCreator;
    /** @var ProductAssembly */
    private $assembly;
 
    public function let(ProductRequestCreator $requestCreator, ProductAssembly $assembly) 
    {
        $this->requestCreator = $requestCreator;
        $this->assembly = $assembly;

        $this->beConstructedWith($requestCreator, $assembly);
        
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ProductController::class);
    }

}