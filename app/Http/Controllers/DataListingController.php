<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DataListingController extends Controller
{
    function index()
    {
        return view('data-listing.listing');
    }
    
}
