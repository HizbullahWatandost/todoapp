<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function uploadAvatar(Request $request){
        if($request->hasFile('image')){
            User::uploadAvatar($request->image);
            return redirect()->back()->with('message', 'uploaded successfully!');
        }
        return redirect()->back()->with('error', 'image not uploaded!');
    }
}
