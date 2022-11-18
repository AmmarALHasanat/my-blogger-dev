<?php

namespace App\Domains\Authentication\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domains\Interfaces\Actionable;
use Illuminate\Database\Eloquent\Builder;
use App\Domains\Authentication\Http\Requests\LoginUserRequest;

class LoginUserAction implements Actionable
{
    protected Request $request;
    protected string $role_name;

    public function __construct(LoginUserRequest $request, string $role_name)
    {
        $this->request = $request;
        $this->role_name = $role_name;
    }

    public function execute(): ? User
    {
        
        $user = User::whereHas('roles', function (Builder $query) {
            $query->where('name', $this->role_name);
        })->where('email', $this->request->email)->first();
        return $user;
    }
}