<?php

namespace App\Repositories\API\v1;

use App\Models\User;
use App\Repositories\Repository;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
