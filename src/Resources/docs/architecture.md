# Architecture

An attempt at the clean architecture

## Namespace

### App\Domain

Contains pure PHP code, that do not rely on framework or specific libraries

Any functionnal requirement is cover via interfaces that glue code will implement
(ex: App/Doamin/Store/ProductStoreInterface)

Domain contains only business rules, organized as UseCases

UseCase follow a simple Command pattern that map the http Request -> Handler -> Response flow of symfony

```php
/** @var App\Domain\Store\ProductStore */
$store = // a storage interface;

/** @var App\Domain\ResponseCreator\ProductResponseCreator */
$responseCreator = // a generator utility class;

/** @var App\Domain\Request\Product\GetProductRequest */
$request = new GetProductRequest(1); // UseCaseRequest carry user intent

/** @var App\Domain\UseCase\Product\GetProduct */
$useCase = new GetProduct($store, $responseCreator); // a specific UseCaseInterface

/** @var App\Domain\UseCase\Response\GetProductResponse */
$response = $useCase->execute($request); // the usecase response

```

Creators are inspired by Redux action creator function (see https://redux.js.org/basics/actions#action-creators)

### App\Http

Contains code that glue domain with the web Framework (Symfony4 in our case)

We will find

* Controllers
* ViewModels
* Assembly

Assembly are convertion helper classes to cast Entity to ViewModel (We do not want to expose entity to templating)

Note: Why do we not want to expose Entity to templating?
> Our entity extends Data Model, following our design, 
> the model can implement application logic methods like product.disable()
> exposing the entity to the view means twig integrators could accidentaly call thoses methods
> View should not mutate state.
> ViewModels are simple DTO (easy to serialize, dump in console, etc) which only carry
> Data State.

### App\Store

Contains glue code that bind Doctrine entities to domain models

### App\Command

Symfony Commands for console controle of the App

### App\Api

Controllers for RESTfull API