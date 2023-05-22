<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{food};

class HomeController extends Controller
{
    public function RedirectOnRole()
    {
        $user = auth()->user();
    
        if ($user->is_admin) {
            return redirect()->route('admin.reservation');
        } else {
            return redirect()->route('reservation');
        }
    }

    public function HomePage(){
        $data = food::with('category')
        ->where('is_deleted', false)
        ->where('status', true)
        ->get();
        return view('welcome' , compact('data'));
    }
}
