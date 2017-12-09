<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersController extends Controller
{
    //]
    public function usersmanage() {
        $users = DB::table('users')->latest()->paginate(10);

        return view('users.usersmanage')->with('users',$users);
    }
}