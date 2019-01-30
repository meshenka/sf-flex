<?php
/**
 * @author Sylvain Gogel <sylvain.gogel@gmail.com>
 * @license MIT
 */
namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\RequestCreator\ProductRequestCreator;
use App\Domain\UseCase\Product\GetProduct;
use App\Http\ViewModel\ProductViewModel;
use App\Http\Assembly\ProductAssembly;
use App\Store\Entity\ProductEntity;

/**
 * @Route("/")
 */
class ProductController extends Controller
{
    /**
     * @var ProductRequestCreator
     */
    private $requestCreator;

    /**
     * @var ProductAssembly
     */
    private $assembly;

    /**
     * __construct
     *
     * @param  ProductRequestCreator $requestCreator
     * @param  ProductAssembly $assembly
     *
     * @return void
     */
    public function __construct(ProductRequestCreator $requestCreator, ProductAssembly $assembly) 
    {
        $this->requestCreator = $requestCreator;
        $this->assembly = $assembly;
    }

    /**
     * @Route("/product/{id}", name="app_product_get", methods="GET")
     *  
     * get
     *
     * @param  ProductEntity $product
     * @param  GetProduct $useCase
     *
     * @return Response
     */
    public function getProduct(ProductEntity $product, GetProduct $useCase): Response
    {

        $useCaseRequest = $this->requestCreator->createGetProduct($product->getId());
        $useCaseResponse = $useCase->execute($useCaseRequest);
        $product = $useCaseResponse->getProduct();

        return $this->render('product/get.html.twig', [
            "product" => $this->assembly->entityToViewModel($product)
        ]);
    }
}