<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class Policy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function admin(User $user)
    {
        return (Auth::user()->role=='Admin' ? Response::allow() : Response::deny('You must be an Admin.'));
    }

    public function pegawai(User $user)
    {
        return (Auth::user()->role=='Pegawai' ? Response::allow() : Response::deny('You must be an Admin.'));
    }
}
