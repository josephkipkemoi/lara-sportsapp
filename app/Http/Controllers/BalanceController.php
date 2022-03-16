<?php

namespace App\Http\Controllers;

use App\DTO\BalanceDTO;
use App\Http\Requests\StoreBalanceRequest;
use App\Models\User;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    //
    public function store(User $user, StoreBalanceRequest $request)
    {
        // $user->balance()->create((array) new BalanceDTO(...$request->validated));
        $user->balance()->create([
            'amount' => $request->validated()['amount']
        ]);
    }

    public function index(User $user)
    {
        return $user->balance;
    }
}
