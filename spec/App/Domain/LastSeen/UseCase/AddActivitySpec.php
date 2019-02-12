<?php

namespace spec\App\Domain\LastSeen\UseCase;

use App\Domain\LastSeen\UseCase\AddActivity;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Domain\LastSeen\UserLastSeenStore;
use App\Domain\LastSeen\Model\UserLastSeen;use Faker\Provider\zh_TW\DateTime;
use App\Domain\LastSeen\UseCase\Request\AddActivityRequest;
use App\Domain\LastSeen\UseCase\Response\AddActivityResponse;
use App\Domain\LastSeen\Exception\UserLastSeenNotFound;


class AddActivitySpec extends ObjectBehavior
{
    public $store;

    public function let(UserLastSeenStore $store) {
        $this->store = $store;
        
        $this->beConstructedWith($store);
        
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(AddActivity::class);
    }

    public function it_create_new_userlastseen_if_not_found() {
        $this->store->findUser("phpspec")->willThrow(UserLastSeenNotFound::class);

        $date = new \DateTime();
        $this->store->new("phpspec", $date)->shouldBeCalled();

        $this->store->persist(Argument::type(UserLastSeen::class))->shouldBeCalled();

        //usecase
        $request = new AddActivityRequest("phpspec", $date);
        $response = $this->execute($request);
        $response->shouldHaveType(AddActivityResponse::class);
    }

    public function it_update_userlastseen_if_date_is_newer(UserLastSeen $user) {

        $user->getId()->willReturn("phpspec");
        $user->getLastSeen()->willReturn((new \DateTime())->modify("-1 day"));
        $this->store->findUser("phpspec")->willReturn($user);

        $date = new \DateTime();
        $user->setLastSeen($date)->shouldBeCalled();
        $this->store->persist($user)->shouldBeCalled();

        //usecase
        $request = new AddActivityRequest("phpspec", $date);
        $response = $this->execute($request);
        $response->shouldHaveType(AddActivityResponse::class);
    }

    public function it_ignore_request_with_older_date(UserLastSeen $user) {
        $user->getId()->willReturn("phpspec");
        $user->getLastSeen()->willReturn(new \DateTime());

        $this->store->findUser("phpspec")->willReturn($user);

        $this->store->persist($user)->shouldNotBeCalled();
        //usecase
        $request = new AddActivityRequest("phpspec", (new \DateTime())->modify("-1 day"));
        $response = $this->execute($request);
        $response->shouldHaveType(AddActivityResponse::class);
    }

}
