<?php

namespace App\Http\Resources;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // protected $message;

    // public function __construct($resource, $message="jhftyd")
    // {
    //     parent::__construct($resource);
    //     $this->message = $message;
    // }

    public function toArray(Request $request): array
    {
        return [
            // 'message' => $this->message,
            'data' => [
                'id' => $this->id,
                'libelle' => $this->libelle,
                'prix' => $this->prix,
                'stock' => $this->stock,
                'fournisseur' => $this->fournisseurs,
                'categorie' => $this->categorie->libelle,
            ]

        ];
    }
}
