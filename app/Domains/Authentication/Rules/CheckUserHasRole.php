<?php

namespace App\Domains\Authentication\Rules;

use App\Domains\Interfaces\Rulable;
use App\Models\User;

class CheckUserHasRole implements Rulable
{
    // check if user has role
    protected string $role_name;
    protected User $user;
    
    public function __construct(User $user , string $role_name)
    {
        $this->user = $user;
        $this->role_name = $role_name;
    }

    public function run(): bool
    {
        return (bool) $this->user->hasRole($this->role_name);
    }

    public function getMessage(): string
    {
        return 'User Account is not '.$this->role_name.' type';
    }

}