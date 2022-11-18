<?php

namespace App\Domains\Authentication\Actions;

use App\Domains\Authentication\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;

class RegisterUserAction implements Actionable
{
    protected Request $request;

    public function __construct(RegisterUserRequest $request)
    {
        $this->request = $request;
    }

    public function execute(): User
    {
        $user = User::create([
            'name' => $this->request->name,
            'email' => $this->request->email,
            'password' => bcrypt($this->request->password),
        ]);
	$user->assignRole('user');
	return $user;
    }

}