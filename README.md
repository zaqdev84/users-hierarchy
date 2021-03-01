# How to install

Requirements

PHP 7.2+

git clone https://github.com/zadev84/users-hierarchy.git .

or 

Download the zip file @ https://github.com/zadev84/users-hierarchy

After downloading it

```
composer install
```

To run all the tests

```
./vendor/phpunit/phpunit/phpunit tests 
```

Starting server

```
php -S localhost:8081
```

and access on your browser
http://localhost:8081


# Overview

This library provides an api to insert roles and users in a hierarchical way

and makes it possible to retrieve a user's subordinates based on roles

Examples:

```php

$roles = [
    [
        'Id' => 1,
        'Name' => 'System Administrator',
        'Parent' => 0
    ],
    [
        'Id' => 2,
        'Name' => 'Location Manager',
        'Parent' => 1,
    ],
    [
        'Id' => 3,
        'Name' => 'Supervisor',
        'Parent' => 2,
    ],
    [
        'Id' => 4,
        'Name' => 'Employee',
        'Parent' => 3,
    ],
    [
        'Id' => 5,
        'Name' => 'Trainer',
        'Parent' => 3,
    ]
];

$users = [
    [
        'Id' => 1,
        'Name' => 'Adam Admin',
        'Role' => 1
    ],
    [
        'Id' => 2,
        'Name' => 'Emily Employee',
        'Role' => 4
    ],
    [
        'Id' => 3,
        'Name' => 'Sam Supervisor',
        'Role' => 3
    ],
    [
        'Id' => 4,
        'Name' => 'Mary Manager',
        'Role' => 2,
    ],
    [
        'Id' => 5,
        'Name' => 'Steve Trainer',
        'Role' => 5
    ]
];

// Add Roles
$roleRepository = new RoleRepository(new RoleCollection);
$roleRepository->saveAll($roles);

// Add Users
$userRepository = new UserRepository(new UserCollection);
$userRepository->saveAll($users);

# Using adaptor 1:

$tree = new RecursiveTreeAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 1)->toJson();

# Using adaptor for external package
$tree = new ExternalPackageAdaptor($roleRepository->getAll());
$subordinates = $userRepository->getSubOrdinates($tree, 5)->toJson();

# Output
[{"Id":2,"Name":"Emily Employee","Role":4},{"Id":3,"Name":"Sam Supervisor","Role":3},{"Id":4,"Name":"Mary Manager","Role":2},{"Id":5,"Name":"Steve Trainer","Role":5}]

# Output 2
[]
```

# Development process

Decided not to use any framework... 

1 - Created a repository layer to retrieve data from in memory collection

2 - Always coding against an interface so we could switch the implementation coding another adaptor

3 - I created 2 adaptors inside src\Service to demonstrate how we would do that.. one with my own algorithm and one using an external package

4 - I created a decorator class to illustrate how to handle output and it's not user class responsibility to convert it to json

5 - The methodology used was TDD - I started coding with tests... The code repo is 100% covered by unit tests as you can see on the following image 

![Alt text](test-coverage.png?raw=true "Title")

# // Todo

1 - Have a service container to handle dependency injections

2 - Have a proper persistent layer and a database to store data.. Right now data is handled in memory

3 - Have entities with explicit properties and setter/getter() methods

4 - Improve the tree mechanism

5 - Add a validation layer to integrate with save methods

6 - Have endpoints to interact with the service such as 

POST /roles

POST /users

GET /users

GET /users/id

GET /users/id/subordinates

