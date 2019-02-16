<?php

namespace spec\App\Domain\LastSeen\UseCase;

use App\Domain\LastSeen\UseCase\GetActivity;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Domain\LastSeen\ActivityStore;
use App\Storage\ActivityEntity;
use App\Domain\LastSeen\UseCase\Request\GetActivityRequest;
use App\Domain\LastSeen\UseCase\Response\GetActivityResponse;
use App\Domain\LastSeen\Exception\ActivityNotFound;
use Psr\Log\NullLogger;

class GetActivitySpec extends ObjectBehavior
{
    public $store;

    public function let(ActivityStore $store) {
        $this->store = $store;
        
        $this->beConstructedWith($store, new NullLogger());
        
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GetActivity::class);
    }

    public function it_get_status_from_model_for_existing_user() {

        //we use the entity to have a concreate implementation of the Model
        $user = new ActivityEntity(); 
        $user->setId("phpspec");
        $user->setLastSeen((new \DateTime())->modify("-1 day"));

        $this->store->findUser("phpspec")->willReturn($user);

        //usecase with 1 day old last activity
        $request = new GetActivityRequest("phpspec");
        $response = $this->execute($request);
        $response->shouldHaveType(GetActivityResponse::class);
        $response->isOnline()->shouldBe(false);
        $response->getLastSeen()->shouldHaveType(\DateTime::class);
        $response->isKnowned()->shouldBe(true);
        

        //use case with a recent last activity
        $user->setLastSeen(new \DateTime());
        $response = $this->execute($request);
        $response->shouldHaveType(GetActivityResponse::class);
        $response->isOnline()->shouldBe(true);
        $response->getLastSeen()->shouldHaveType(\DateTime::class);
        $response->isKnowned()->shouldBe(true);
        
    }

    public function it_always_return_offline_status_for_non_existing_user_id(){
        //train store to throw
        $this->store->findUser("phpspec")->willThrow(ActivityNotFound::class);

        //usecase
        $request = new GetActivityRequest("phpspec");
        $response = $this->execute($request);
        $response->shouldHaveType(GetActivityResponse::class);
        $response->isOnline()->shouldBe(false);
        $response->getLastSeen()->shouldBe(null);
        $response->isKnowned()->shouldBe(false);
        
    }

}
