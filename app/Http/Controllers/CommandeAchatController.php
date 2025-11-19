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


    public function Liste_Comanande_Achats(){

        $commandesachat=Commandeachat::all();
      
        return view ("Achats/Commande_Achat", compact("commandesachat"));
    }

    

    public function Liste_Achats($id)
    {
        
     $detaillesCommandes=Detailcommandeachat::where("CommandeAchatID",$id)->get();

    // dd($detaillesCommandes);

     

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
        return redirect()->route('achats.commande_achats');
        
    }

    public function edit ($id2)
    {
      
        $detailsCommandeAchat=Detailcommandeachat::findOrFail($id2);
        
        $fournisseurs=Fournisseur::all();
        $statuts=StatutCommande::all();
        $articles=Article::all();
        return view("Achats/Modifier_CommandeAchat", compact("detailsCommandeAchat","fournisseurs","statuts","articles"));
    }


    public function update ($id1, $id2, Request $request)
    {
 
          $detailsCommandeAchat=Detailcommandeachat::findOrFail($id2);
        $CommandeAchat=Commandeachat::find( $detailsCommandeAchat->CommandeAchatID);

          $detailsCommandeAchat->update($request->all());
           $CommandeAchat->update($request->all());

          return redirect(route("achats.liste_achats", ["id"=>$id1]));

    }



    public function Supprimer($id1, $id2)
    {

        return view("Achats/Delete_CommandeAchat", compact("id1", "id2"));

    }



    public function Delete($id1, $id2)
    {

        

        Detailcommandeachat::destroy($id2);

        return redirect(route("achats.liste_achats",['id' => $id1]));
    }



    
}