<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserManagementController extends Controller
{
    public function index()
    {
        $users = User::all(); // or paginate(20)
        return view('admin.users.index', compact('users'));
    }
}
