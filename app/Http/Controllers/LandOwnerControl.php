<?php

namespace App\Http\Controllers;

use App\Models\LandOwner;
use Illuminate\Http\Request;

class LandOwnerControl extends Controller
{
    public function index(){
        $owners = LandOwner::orderByDesc('created_at')->get();
        return view('admin.owners', compact('owners'));
    }
    public function viewLandOwner($id){
        // dd($id);
        $owner = LandOwner::findOrFail($id);
        return view('admin.owner-view', compact('owner'));
    }
}
