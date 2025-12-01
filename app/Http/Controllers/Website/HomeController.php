<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Offer;
class HomeController extends Controller
{
    public function index()
    {
        $countries = Country::with(['regions.branches'])->get();
        $offers = Offer::all();
        
        return view('website/index', compact('countries', 'offers'));
    }
}
