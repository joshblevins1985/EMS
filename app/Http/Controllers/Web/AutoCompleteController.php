<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use GooglePlaces;



class AutoCompleteController extends Controller
{
    //for create controller - php artisan make:controller AutocompleteController

    function index()
    {
     return view('autocomplete');
    }

    function fetch(Request $request)
    {
     if($request->get('query'))
     {
        
         
           $googlePlaces = new GooglePlaces('AIzaSyA1miNu5y61IhwpHaHHtvO_zZYXGg94XLY');
        $response = $googlePlaces->placeAutocomplete('my_id_here');
         

        echo $response;
     }
    }
}
