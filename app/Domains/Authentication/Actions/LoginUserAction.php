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

    public function __construct(LoginUserRequest $request)
    {
        $this->request = $request;
    }

    public function execute(): ? User
    {
        return User::where('email', $this->request->email)->first();
    }
}