<?php

namespace App\Http\Controllers;

use App\Beer;
use App\Brewery;
use App\Http\Requests\NotifyBrewery;
use App\Http\Requests\NotifyBreweryUpdate;
use App\Jobs\SentimentAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BreweryController extends Controller
{
    public function notify(NotifyBrewery $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        /*
        DB::insert('insert into breweries
            (name, description,img, created_at, updated_at) 
        values 
        (?, ?, ?, ?, ?)',
        [
            $name, $description, '/img/bar2.jpg',
            Carbon::now(),
            Carbon::now(),
            ]);
        */
        /*
        DB::table('breweries')->insert(
            [
                'name' => $name,
                'description' => $description,
                'img' => '/img/bar2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ]
            );
        
            */
        /*
        $breweryNotified = new Brewery();

        $breweryNotified->name = $name;
        $breweryNotified->description = $description;
        $breweryNotified->img = '/img/bar2.jpg';

        $breweryNotified->save();
        */

        //Mass assignment
        $img = $request->file('img')->store('public/img');
        Brewery::create(compact('name', 'description', 'img'));

        return redirect(route('breweries.thankyou'));
    }

    public function thankyou()
    {
        return view('breweries.thankyou');
    }
    
    public function approved($id)
    {
        $user = Auth::user();

        if($user && $user->isAdmin){
            $brewery = Brewery::find($id);
            $brewery->visible = 1;
            $brewery->save();
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $user = Auth::user();

        if($user && $user->isAdmin){
            $brewery = Brewery::with(['beers', 'comments'])->find($id);
            
        } else {
            $brewery = Brewery::with(['beers', 'comments'])->where('visible', true)
                    ->where('id', $id)
                    ->first();
        }

        if ($brewery == null) {
            return 'questa birreria non esiste';
        }

        $beers = Beer::all();

        return view('breweries.show', compact('brewery', 'beers'));
    }

    public function update(NotifyBreweryUpdate $request, $id)
    {
        //Questa logica non mi serve più
        // $user = Auth::user();
        // if($user && $user->isAdmin){
        // } else {
        //     return "accesso negato";
        // }

        $brewery = Brewery::find($id);

        $img = $request->file('img');

        if ($img != null) {
            $img = $img->store('public/img');
            $brewery->img = $img;
        }

        $brewery->name =  $request->input('name');
        $brewery->description = $request->input('description');
        $brewery->lat = $request->input('lat');
        $brewery->lon = $request->input('lon');
        $brewery->save();

        return redirect(route('breweries.show', ['id' => $brewery->id ]));
    }

    public function delete($id)
    {
        $user = Auth::user();
        if ($user && $user->isAdmin){
            Brewery::destroy($id);
        }
        return redirect(route('breweries'));
    }

    public function addComment($id, Request $request)
    {
        $user = Auth::user();
        $brewery = Brewery::find($id);

        $comment = $brewery->comments()->create([
            'comment' => $request->input('comment'),
            'user_id' => $user->id,
        ]);

        dispatch(new SentimentAnalysis($comment->id));

        return redirect(route('breweries.show', [ 'id' => $id ] ));
    }

    public function beersSync($id, Request $request)
    {
        $beer_ids = $request->input('beer_ids');
        $brewery = Brewery::find($id);
        $brewery->beers()->sync($beer_ids);
        return redirect(route('breweries.show', ['id' => $id]));
    }

}
