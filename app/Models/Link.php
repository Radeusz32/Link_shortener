<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'short_code'];

    public static function generateShortCode($originalUrl)
    {
        // Usuwamy http:// lub https://, jeśli istnieje
        $domain = preg_replace("~^(https?:\/\/)?(www\.)?~", "", $originalUrl);
        
        // Pobieramy tylko nazwę domeny bez końcówki (np. "youtube" z "youtube.pl")
        $domainParts = explode(".", $domain);
        if (count($domainParts) < 2) {
            return substr(md5(uniqid()), 0, 6); // Awaryjny kod, jeśli coś pójdzie źle
        }
    
        $domainName = $domainParts[0]; // youtube
        $tld = $domainParts[count($domainParts) - 1]; // pl
    
        // Pobieramy 2 pierwsze i 2 ostatnie litery nazwy domeny
        $first = substr($domainName, 0, 1);
        $last = substr($domainName, -1);
    
        // Generujemy dwie losowe cyfry
        $randomNumbers = rand(10, 99);
    
        // Składamy finalny kod: np. "yobe31.pl"
        return strtolower($first . $last . $randomNumbers . "." . $tld);
    }    
}