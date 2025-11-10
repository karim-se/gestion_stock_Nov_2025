<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commandeachat;
use App\Models\Detailcommandeachat;
use App\Models\Article;
use App\Models\Fournisseur;
use App\Models\StatutCommande;



class CommandeAchatController extends Controller
{

    

    public function Liste_Achats()
    {
        
     $detaillesCommandes=Detailcommandeachat::all();

     

     return view("Achats/Liste_Achats", compact("detaillesCommandes"));

    }


    public function Ajouter_CommandeAchat()
    {


        $fournisseurs=Fournisseur::all();
        $status=StatutCommande::all();
        $articles=Article::all();
        return view("Achats/Ajouter_CommandeAchat", compact(['fournisseurs',"status", "articles"]));
    }


    public function Store_CommandeAchat(Request $request)
    {

        $Commandeachat=Commandeachat::create($request->all());


        Detailcommandeachat::create(
            
            [
                "CommandeAchatID" => $Commandeachat->CommandeAchatID,
                "ArticleID" => $request->ArticleID,
                "Quantite" => $request->Quantite,
                "PrixUnitaire" => $request->PrixUnitaire,
            ]
        
        );
   
            $article = Article::find($request->ArticleID);
            
                if ($article && $request->Statut_ID == 2) {
                    $article->StockActuel += $request->Quantite;
                    $article->save();
                }
        
        return redirect()->route('Listes_Achats');
        
    }



    
}