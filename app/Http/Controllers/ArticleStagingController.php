<?php

namespace App\Http\Controllers;
use App\Models\article_staging;
use App\Models\Categorie;
use App\Models\StatutCommande;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ArticleStagingController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = article_staging::with('createur');

        // Filtrer par statut si demandé
        if ($request->has('statut')) {
            $query->where('statut', $request->statut);
        }

        $articles = $query->orderBy('created_at', 'desc')->get();

        return view('Articles/Liste_articles_Staging', compact('articles'));
    }

    public function create()
    {
        $categories = Categorie::all();
        $status = StatutCommande::all();
        return view('Articles/Ajouter_Article', compact('categories', 'status'));
    }

    public function store(Request $request)
    {
        article_staging::create([...$request->all(), 'created_by' => auth()->id(), 'statut' => article_staging::STATUT_EN_ATTENTE]);

        return redirect()->route('articles.articles-staging.index');
    }

    public function show($id)
    {
        $articleStaging = article_staging::find($id);

        $articleStaging->load(['categorie', 'createur', 'validateur']);

        return view('Articles/show', compact('articleStaging'));
    }

    public function valider($id)
    {
        $articleStaging = article_staging::find($id);

        DB::transaction(function () use ($articleStaging) {
            // Créer l'article principal
            Article::create([
                'NomArticle' => $articleStaging->NomArticle,
                'CodeArticle' => $articleStaging->CodeArticle,
                'CategorieID' => $articleStaging->categorieID,
                'Description' => $articleStaging->Description,
                'PrixAchatStandard' => $articleStaging->PrixAchatStandard,
                'PrixVenteStandard' => $articleStaging->PrixVenteStandard,
                'StockActuel' => $articleStaging->StockActuel,
                'StockMinimum' => $articleStaging->StockMinimum,
                'created_by' => $articleStaging->created_by,
            ]);

            $articleStaging->update([
                'statut' => article_staging::STATUT_VALIDE,
                'validated_by' => auth()->id(),
                'validated_at' => now(),
            ]);
        });

        return redirect()->route('articles.articles-staging.index');
    }

    public function rejeter(Request $request, article_staging $articleStaging)
    {
        $articleStaging->update([
            'statut' => article_staging::STATUT_REJETE,
            'validated_by' => auth()->id(),
            'validated_at' => now(),
            'raison_rejet' => $request['raison_rejet'],
        ]);

        return redirect()->route('articles.articles-staging.index');
    }
}
