<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Commandeachat;
use App\Models\Detailcommandeachat;
use App\Models\Article;
use App\Models\Fournisseur;
use App\Models\StatutCommande;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CommandeAchatController extends Controller
{


   public function Liste_Comanande_Achats()
{
  

    $commandesachat =  DB::table('commandeachats')
            ->leftJoin('fournisseurs', 'commandeachats.FournisseurID', '=', 'fournisseurs.FournisseurID')
            ->leftJoin('statut_commande', 'commandeachats.Statut_ID', '=', 'statut_commande.Statut_ID')
            ->select(
                'commandeachats.CommandeAchatID',
                'commandeachats.DateCommande',
                'fournisseurs.NomFournisseur',
                'statut_commande.Statut'
            )
            ->orderBy('commandeachats.CommandeAchatID') // toujours ordonner pour la pagination
            ->get();
    

    return view("Achats/Commande_Achat/ListeCommandeAchat", compact("commandesachat"));
}



    public function Create()
    {


        $fournisseurs=Fournisseur::all();
        $status=StatutCommande::all();
        $articles=Article::all();
        return view("Achats/Commande_Achat/Ajouter_CommandeAchat", compact(['fournisseurs',"status", "articles"]));
    }


    public function Store(Request $request)
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






     public function Edit ($id2)
    {

    
        $commandeAchat=Commandeachat::findOrFail($id2);
        
        $fournisseurs=Fournisseur::all();
        $statuts=StatutCommande::all();
  
        return view("Achats/Commande_Achat/Modifier_CommandeAchat", compact("commandeAchat","fournisseurs","statuts"));
    }


       public function Update ($id1, Request $request)
    {
 
  
        $CommandeAchat=Commandeachat::find( $id1);

     
           $CommandeAchat->update($request->all());

          return redirect(route("achats.commande_achats", ["id"=>$id1]));

    }


    public function Supprimer($id1)
    {

        return view("Achats/Commande_Achat/Delete_CommandeAchat", compact("id1"));

    }



    public function Delete($id1)
    {

        

        Commandeachat::destroy($id1);

        return redirect(route("achats.commande_achats"));
    }

}