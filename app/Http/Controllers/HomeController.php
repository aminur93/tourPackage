<?php

namespace App\Http\Controllers;

use App\Packge;
use App\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $package = Packge::where('status',1)->paginate(2);
        return view('welcome',compact('package'));
    }
    
    public function show($id)
    {
        $package = Packge::findOrFail($id);
        return view('activities',compact('package'));
    }
    
    public function store(Request $request)
    {
         
           $packageact = new TourPackage();
           
           $packageact->package_id = $request->packageId;
           $packageact->activity = $request->activity;
           $packageact->details = $request->details;
           
           $packageact->save();
         
         return redirect()->back()->with('msg','Your package Activities successfully');
    }
}
