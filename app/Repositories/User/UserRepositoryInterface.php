<?php

namespace App\Repositories\User;

use App\User;
use App\Repositories\RepositoryInterface;
use Throwable;

interface UserRepositoryInterface extends RepositoryInterface
{

     public function createAndGetID($data);

     public function sortWithFirstLetter($num);
}