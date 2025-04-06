<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataListingController extends Controller
{
    function index()
    {
        return view('data-listing.listing');
    }
}
