<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = Buyer::all(); // Or use pagination: Buyer::paginate(10)

        return view('admin.usertable', compact('buyers'));
    }
}

