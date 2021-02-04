<?php

namespace App\Http\Controllers;

use App\Brewery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $myTime = Carbon::now();
        $time = $myTime->toDateTimeString();
        return view('index', ['time'=> $time]);
    }
    
    public function search(Request $request)
    {
        $q = $request->input('q');

        $breweries = Brewery::search($q)->where('visible', true)->query(function ($builder){
            $builder->with(['beers', 'comments']);
        })->get();

        return view('search_results', compact('q', 'breweries'));
    }

    public function breweries() {
        $user = Auth::user();
        if($user && $user->isAdmin) {
            $breweries = Brewery::with(['beers', 'comments'])
            ->orderBy('id', 'desc')
            ->get();
        } else {
            $breweries = Brewery::with(['beers', 'comments'])->where('visible', true)
                ->orderBy('id', 'desc')
                ->get();
        }
        
    
        return view('breweries', compact('breweries'));
    }

    public function team() {
        $members = [
            [
            'name' => 'Giancarlo',
            'role' => 'CTO',
            'img' => '/img/bar1.jpg',
            ],
            [
            'name' => 'Andrea',
            'role' => 'developer',
            'img' => 'https://tse1.mm.bing.net/th?id=OIP.ng7NrTXc2lFNWU-bYfoDggHaEH&pid=Api',
            ],
            [
            'name' => 'Gaia',
            'role' => 'influencer',
            'img' => 'https://tse1.mm.bing.net/th?id=OIP.ng7NrTXc2lFNWU-bYfoDggHaEH&pid=Api',
            ],
            [
            'name' => 'Francesco',
            'role' => 'teacher',
            'img' => 'https://tse1.mm.bing.net/th?id=OIP.ng7NrTXc2lFNWU-bYfoDggHaEH&pid=Api',
            ],
            [
            'name' => 'Federica',
            'role' => 'tutor',
            'img' => 'https://tse1.mm.bing.net/th?id=OIP.ng7NrTXc2lFNWU-bYfoDggHaEH&pid=Api',
            ],
        ];
        return view('team', compact('members'));
    }
    
    public function aboutUs() {
        return view('about');
    }
}
