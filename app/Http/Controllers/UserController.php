<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Request\UpdateUsersRequest;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user
        ]);
    }

    public function update(UpdateUsersRequest $request, User $user)
    {
        $data = $request->validated();
        $user->fill($data);

        if ($user->update()) {
            return redirect()->route('home')->with('success', 'Пользователь успешно изменен!');
        }

        return back()->with('error', 'Ошибка изменения Пользователя');
    }
}
