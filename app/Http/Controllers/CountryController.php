<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function list(Request $request)
    {
        return 
        [
            'results' => Country::select(['id', 'name as text'])
            ->where('name', 'LIKE', '%'.$request->input('term').'%')
            ->take(20)
            ->get() 
        ]; 
    }

    public function selectedCountries(Request $request)
    {
        return $request->user()->selectedCountries()->get();
    }

    public function addSelectedCountry(Request $request)
    {
        $country = Country::findOrFail($request->input('countryId'));

        $request->user()->selectedCountries()->attach($request->input('countryId'));
        $request->user()->save();

        return ['status' => 'success',
            'country_code' => "$country->country_code"];
    }

    public function deleteSelectedCountry(Request $request)
    {
        $country = Country::findOrFail($request->input('countryId'));
        
        $request->user()->selectedCountries()->detach($request->input('countryId'));
        $request->user()->save();

        return ['country_code' => "$country->country_code",
            'status' => 'success'];
    }
}