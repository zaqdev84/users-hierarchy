<?php

declare(strict_types=1);

namespace UsersHierarchy\Services\Tree;

interface AdaptorInterface
{
    public function buildTree(int $parentId): AdaptorInterface;

    public function getAllDescendantsIds(): array;
}