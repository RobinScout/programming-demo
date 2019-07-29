<?php

namespace App\Http\Controllers;

use App\Joke;
use Illuminate\Http\Request;

class JokeController extends Controller
{
    public function index(Request $request)
    {
        return view('joke.index');
    }

    public function random(Request $request)
    {
        try {
            $joke = json_decode(file_get_contents('https://api.chucknorris.io/jokes/random'));
            $joke = Joke::updateOrCreate(
                ['id' => $joke->id],
                ['value' => $joke->value]
            );
        }
        catch (\Exception $e) {
            $joke = Joke::inRandomOrder()->first();
        }

        return response()->json($joke);
    }

    public function search(Request $request)
    {
        $query = Joke::query();

        foreach($request->query('values') as $value) {
            $query->orWhere('value', 'LIKE', '%' . $value . '%');
        }

        $jokes = $query->get();

        return response()->json($jokes);
    }
}
