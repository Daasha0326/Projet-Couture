<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    // public $message;

    // public function __construct($resource,$text="success"){
    //     $this->message = $text;
    //     parent::__construct($resource);
    // }

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($article) {
                return [
                    'id' => $article->id,
                    'libelle' => $article->libelle,
                    'prix' => $article->prix,
                    'stock' => $article->stock,
                    'categorie_id' => $article->categorie_id,
                ];
            })
        ];
    }
}