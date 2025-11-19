<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commandeachat;
use App\Models\Detailcommandeachat;
use App\Models\Article;
use App\Models\Fournisseur;
use App\Models\StatutCommande;
use PhpParser\NodeVisitor\CommentAnnotatingVisitor;



class DetailCommandeAchatController extends Controller
{


    

    

    public function Liste_Achats($id)
    {
        
     $detaillesCommandes=Detailcommandeachat::where("CommandeAchatID",$id)->get();
    
     $commandeAchat=Commandeachat::find($id);
   
    


   



     return view("Achats/Detail_Commande_Achat/Liste_Achats", compact("detaillesCommandes", "commandeAchat"));

    }


    public function Create($id)
    {

        $commandeAchat=Commandeachat::find($id);
        $fournisseurs=Fournisseur::all();
        $status=StatutCommande::all();
        $articles=Article::all();
        return view("Achats/Detail_Commande_Achat/Ajouter_DetailCommandeAchat", compact(['fournisseurs',"status", "articles", "commandeAchat"]));
    }


    public function Store(Request $request,$id)
    {
        
       
        


       foreach ($request->articles as $article) {
          
    DetailCommandeAchat::create([
        'CommandeAchatID' => $id,
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
   return redirect(route("achats.liste_achats", ["id"=>$id]));
        
    }

    public function Edit ($id2)
    {
      
        $detailsCommandeAchat=Detailcommandeachat::findOrFail($id2);
        
       
        $articles=Article::all();
        return view("Achats/Detail_Commande_Achat/Modifier_DetailCommandeAchat", compact("detailsCommandeAchat","articles"));
    }


    public function Update ($id1, $id2, Request $request)
    {
 
          $detailsCommandeAchat=Detailcommandeachat::findOrFail($id2);
       

          $detailsCommandeAchat->update($request->all());
         

          return redirect(route("achats.liste_achats", ["id"=>$id1]));

    }



    public function Supprimer($id1, $id2)
    {

        return view("Achats/Detail_Commande_Achat/Delete_DetailCommandeAchat", compact("id1", "id2"));

    }



    public function Delete($id1, $id2)
    {

        

        Detailcommandeachat::destroy($id2);

        return redirect(route("achats.liste_achats",['id' => $id1]));
    }



    
}