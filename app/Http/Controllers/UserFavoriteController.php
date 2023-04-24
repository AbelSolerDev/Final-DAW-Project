<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserFavorite;
use App\Models\MobilHome;
use Illuminate\Support\Facades\Auth;


class UserFavoriteController extends Controller
{
    public function show(MobilHome $mobilHome)
    {
        $user = Auth::user();
    
        // Verificar si la casa móvil está en los favoritos del usuario
        $isFavorite = UserFavorite::where('user_id', $user->id)
            ->where('mobil_home_id', $mobilHome->id)
            ->exists();
    
        return view('sales.show', compact('mobilHome', 'isFavorite'));
    }
    public function store(Request $request)
    {   
        $user = Auth::user();
        $mobilHome = MobilHome::findOrFail($request->mobilHome);

        if ($user->favorites->contains($mobilHome->id)) {
            return redirect()->route('sale.show', compact('mobilHome'));
        }

        $favorite = new UserFavorite();
        $favorite->user_id = $user->id;
        $favorite->mobil_home_id = $mobilHome->id;

        // Verificar si ya existe una fila con los mismos valores
        $existingFavorite = UserFavorite::where('user_id', $user->id)
            ->where('mobil_home_id', $mobilHome->id)
            ->first();
        if ($existingFavorite) {
            return redirect()->route('sale.show', compact('mobilHome'));
        }

        $favorite->save();

        return redirect()->route('sale.show', compact('mobilHome'));
    }

    public function destroy(UserFavorite $favorite)
    {
        auth()->user()->favorites()->where('id', $favorite->id)->delete();
    
        $isFavorite = false;
        return redirect()->route('sale.show', ['mobilHome' => $favorite->mobil_home_id, 'isFavorite' => $isFavorite]);
    }
    
}
    


    /*public function destroy($favoriteId)
    {
        auth()->user()->favorites()->where('id', $favoriteId)->delete();

        return back();
    }*/
    /*public function destroy($favoriteId)
    {
        $favorite = UserFavorite::find($favoriteId);
        
        if (!$favorite) {
            return back();
        }
        
        $favorite->where('id', $favoriteId)->delete();

        dd();
        return back();
    }*/
