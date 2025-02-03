<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class LinkController extends Controller
{
    // Tworzenie skróconego linku
    public function store(Request $request)
    {
        $originalUrl = $request->original_url;
    // Sprawdzamy czy link ma https:// lub http:// przed nazwa, jeśli nie ma to dodajemy
        if (!preg_match("~^(http|https)://~", $originalUrl)) {
            $originalUrl = "https://" . $originalUrl;
        }
    // Walidacja linku
        $validatedData = validator(
            ['original_url' => $originalUrl],
            ['original_url' => 'required|url']
        )->validate();

        $shortCode = Link::generateShortCode($originalUrl);

        $link = Link::create([
            'original_url' => $originalUrl,
            'short_code' => $shortCode
        ]);

        return response()->json([
            'original_url' => $originalUrl,
            'short_code' => $shortCode
        ]);
    }

    // Pobranie listy wszystkich linków
    public function index()
    {
        return response()->json(Link::all());
    }

    // Przekierowanie na pełny adres URL
    public function redirect($shortCode)
    {
        $link = Link::where('short_code', $shortCode)->first();

        if (!$link) {
            abort(404);
        }

        return redirect()->to($link->original_url);
    }
}

