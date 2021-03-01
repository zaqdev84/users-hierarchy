<?php

declare(strict_types=1);

namespace UsersHierarchy\Repository;

use UsersHierarchy\InMemoryCollection\RoleCollection;

class RoleRepository extends Repository implements RepositoryInterface
{
    /** @var RoleCollection $role */
    protected $collection;

    public function __construct(RoleCollection $collection)
    {
        $this->collection = $collection;
    }
}