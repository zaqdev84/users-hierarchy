<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\Traits\SeedsData;
use UsersHierarchy\Repository\RoleRepository;
use UsersHierarchy\Repository\UserRepository;
use UsersHierarchy\Services\Tree\AdaptorInterface;

class RecursiveTreeAdaptorTest extends TestCase
{
    use SeedsData;

    /** @var RoleRepository $repository */
    private $roleRepository;

    /** @var UserRepository $userRepo*/
    private $userRepo;

    /** @var AdaptorInterface $adaptor */
    private $adaptor;

    /** Name of the adaptor to be used */
    private $adaptorName = 'UsersHierarchy\Services\Tree\RecursiveTreeAdaptor';

    /** @test */
    public function it_should_return_4_subordinate_users_for_user_no_1()
    {
        $users = $this->userRepo->getSubOrdinates($this->adaptor, 1);

        $this->assertCount(
            4,
            $users->toArray()
        );
    }

    /** @test */
    public function it_should_return_4_subordinate_users_for_user_no_2()
    {
        $users = $this->userRepo->getSubOrdinates($this->adaptor, 2);

        $this->assertEmpty(
            $users->toArray()
        );
    }

    /** @test */
    public function it_should_return_2_subordinate_users_for_user_no_3()
    {
        $users = $this->userRepo->getSubOrdinates($this->adaptor, 3);

        $this->assertCount(
            2,
            $users->toArray()
        );
    }

    /** @test */
    public function it_should_return_3_subordinate_users_for_user_no_4()
    {
        $users = $this->userRepo->getSubOrdinates($this->adaptor, 4);

        $this->assertCount(
            3,
            $users->toArray()
        );
    }

    /** @test */
    public function it_should_return_3_subordinate_users_for_user_no_5()
    {
        $users = $this->userRepo->getSubOrdinates($this->adaptor, 5);

        $this->assertEmpty(
            $users->toArray()
        );
    }
}
