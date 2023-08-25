<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\FrsResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategorieResource;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function liste()
    {
        $article =  Article::all();
        return  ArticleResource::collection($article);
    }
    public function index()
    {
        
        $categorie =  CategorieResource::collection(Categorie::all(),);
        $fournisseur =  FrsResource::collection(Fournisseur::all());
        $catfour = [
            'categorie'=>$categorie,
            'fournisseur'=>$fournisseur
        ];   
        return $catfour;

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return DB::transaction(function () use($request){
            return  Article::create([
                "libelle" => $request->libelle,
                "prix" => $request->prix,
                "stock"=>$request->stock,
                'photo' => $request->photo,
                'categorie_id' => $request->categorie,
                'reference'=> $this->generateRef($request->libelle,$request->categorie),
            ]);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $articleId,)
    {
        $article = Article::find($articleId);

        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!$article) {
            return response()->json(['message'=>"Article inexistante"]);
        }

        $exist = Article::where('libelle',$article->libelle)->first();

        if (!$exist) {
            return response()->json(['message'=>"L'article n'existe pas.", "data"=>null]);
        }

        $article->update(['libelle' => $request->libelle,]);
        $article->save();
        return response()->json($article);
    }

    
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(['message' => "Article supprimé avec succés"]);
    }
    
    public function generateRef($libelle, $categorieId)
    {
        $categorie = Categorie::find($categorieId);
        $ref = "REF-" . substr($libelle, 0, 3) . "-" . strtoupper($categorie->libelle) . "-" . Article::where('categorie_id', $categorieId)->count();
        return $ref;
    }
}
