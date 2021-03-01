<?php

declare(strict_types=1);

namespace UsersHierarchy\Repository;

use UsersHierarchy\Decorator\ArrayDecorator;
use UsersHierarchy\Services\Tree\AdaptorInterface;

interface UsersHierarchyInterface
{
    public function getSubOrdinates(AdaptorInterface $adaptor, int $userId): ArrayDecorator;
}