<?php

namespace spec\App\Domain\LastSeen\UseCase;

use App\Domain\LastSeen\UseCase\GetLastSeen;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Domain\LastSeen\UserLastSeenStore;
use App\Storage\UserLastSeenEntity;
use App\Domain\LastSeen\UseCase\Request\GetLastSeenRequest;
use App\Domain\LastSeen\UseCase\Response\GetLastSeenResponse;
use App\Domain\LastSeen\Exception\UserLastSeenNotFound;
use Psr\Log\NullLogger;

class GetLastSeenSpec extends ObjectBehavior
{
    public $store;

    public function let(UserLastSeenStore $store) {
        $this->store = $store;
        
        $this->beConstructedWith($store, new NullLogger());
        
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GetLastSeen::class);
    }

    public function it_get_status_from_model_for_existing_user() {

        //we use the entity to have a concreate implementation of the Model
        $user = new UserLastSeenEntity(); 
        $user->setId("phpspec");
        $user->setLastSeen((new \DateTime())->modify("-1 day"));

        $this->store->findUser("phpspec")->willReturn($user);

        //usecase with 1 day old last activity
        $request = new GetLastSeenRequest("phpspec");
        $response = $this->execute($request);
        $response->shouldHaveType(GetLastSeenResponse::class);
        $response->isOnline()->shouldBe(false);
        $response->getLastSeen()->shouldHaveType(\DateTime::class);

        //use case with a recent last activity
        $user->setLastSeen(new \DateTime());
        $response = $this->execute($request);
        $response->shouldHaveType(GetLastSeenResponse::class);
        $response->isOnline()->shouldBe(true);
        $response->getLastSeen()->shouldHaveType(\DateTime::class);

    }

    public function it_always_return_offline_status_for_non_existing_user_id(){
        //train store to throw
        $this->store->findUser("phpspec")->willThrow(UserLastSeenNotFound::class);

        //usecase
        $request = new GetLastSeenRequest("phpspec");
        $response = $this->execute($request);
        $response->shouldHaveType(GetLastSeenResponse::class);
        $response->isOnline()->shouldBe(false);
        $response->getLastSeen()->shouldBe(false);
        
    }

}
