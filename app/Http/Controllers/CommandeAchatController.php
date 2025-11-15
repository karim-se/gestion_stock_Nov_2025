<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commandeachat;
use App\Models\Detailcommandeachat;
use App\Models\Article;
use App\Models\Fournisseur;
use App\Models\StatutCommande;
use PhpParser\NodeVisitor\CommentAnnotatingVisitor;



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


       foreach ($request->articles as $article) {
          
    DetailCommandeAchat::create([
        'CommandeAchatID' => $Commandeachat->CommandeAchatID,
        'ArticleID' => $article['ArticleID'],
        'Quantite' => $article['Quantite'],
        'PrixUnitaire' => $article['PrixUnitaire'],
    ]);


   
            $art = Article::find($article['ArticleID']);
            
                if ($art && $request['Statut_ID'] == 2) {
                    $art->StockActuel += $article['Quantite'];
                    $art->save();
                }
  }      
        return redirect()->route('achats.liste_achats');
        
    }

    public function edit ($id)
    {

        $detailsCommandeAchat=Detailcommandeachat::findOrFail($id);
        $fournisseurs=Fournisseur::all();
        $statuts=StatutCommande::all();
        $articles=Article::all();
        return view("Achats/Modifier_CommandeAchat", compact("detailsCommandeAchat","fournisseurs","statuts","articles"));
    }


    public function update ($id, Request $request)
    {
 
          $detailsCommandeAchat=Detailcommandeachat::findOrFail($id);
        $CommandeAchat=Commandeachat::find( $detailsCommandeAchat->CommandeAchatID);

          $detailsCommandeAchat->update($request->all());
           $CommandeAchat->update($request->all());

          return redirect(route("achats.liste_achats"));

    }



    public function Supprimer($id)
    {

        return view("Achats/Delete_CommandeAchat", compact("id"));

    }



    public function Delete($id)
    {

        Detailcommandeachat::destroy($id);

        return redirect(route("achats.liste_achats"));
    }



    
}