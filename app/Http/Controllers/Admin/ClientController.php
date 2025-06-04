<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;


class ClientController extends Controller
{
    public function index()
    {
        // Assuming you have a roles relationship and a 'client' role slug/name
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->paginate(15);

        return view('admin.clients.index', compact('clients'));
    }
}
