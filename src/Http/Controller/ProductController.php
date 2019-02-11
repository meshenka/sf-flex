<?php
/**
 * @author Sylvain Gogel <sylvain.gogel@gmail.com>
 * @license MIT
 */
namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\RequestCreator\ProductRequestCreator;
// use App\Domain\UseCase\Product\GetProduct;
// use App\Http\ViewModel\ProductViewModel;
use App\Http\Assembly\ProductAssembly;
use App\Store\Entity\ProductEntity;
use App\Domain\UseCase\Product\GetProduct;

/**
 * @Route("/")
 */
class ProductController extends AbstractController
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
     * @Route("/p/{id}", name="app_p_get", methods="GET")
     */
    public function index($id): Response
    {
        return $this->render('index.html.twig');
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
    public function show(ProductEntity $product, GetProduct $useCase): Response
    {
        
        // $useCaseRequest = $this->requestCreator->createGetProduct($product->getId());
        // $useCaseResponse = $useCase->execute($useCaseRequest);
        // $product = $useCaseResponse->getProduct();

        return $this->render('product/get.html.twig', [
            "product" => $this->assembly->entityToViewModel($product)
        ]);
        
    }
}