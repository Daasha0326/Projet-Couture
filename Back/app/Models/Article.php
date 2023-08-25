<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $guarded=[

    ];

    public function fournisseurs()
    {
        return $this->belongsToMany(Fournisseur::class, 'approvisionnements');
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    protected static function booted():void
    {
        static::created(function (Article $article) {
            $article->fournisseurs()->attach(request()->fournisseurs);
        });
    }
   
}
