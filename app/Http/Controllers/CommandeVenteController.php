<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\StatutCommande;
use App\Models\Commandevente;



use App\Models\Detailcommandevente;

class CommandeVenteController extends Controller
{
    //
      public function Liste_Ventes(){

      $commandesventes=Commandevente::all();

        return View("Ventes/Commande_Vente/Liste_CommandeVentes", compact("commandesventes"));
   }


    
    public function Create()
    {


        $articles=Article::all();
        $clients=Client::all();
        $status=StatutCommande::all();

        return view("Ventes/Commande_Vente/Ajouter_CommandeVente", compact ("clients", "status", "articles"));

    }


    public function Store(Request $request)
    {
  
       
        
         $commandevente= Commandevente::create($request->all());


         foreach ($request->articles as $article) {

         Detailcommandevente::create(
            [
            "CommandeVenteID"=>$commandevente->CommandeVenteID ,   
            "ArticleID"=>$article["ArticleID"],
            "PrixUnitaire"=>$article["PrixUnitaire"],
            "Quantite"=>$article["Quantite"]
            ]
            );


            $art = Article::find($article['ArticleID']);
            if ($request['Statut_ID'] == 2)
            {
               
                Article::where('articleID',$article["ArticleID"])
                         ->decrement('StockActuel',$article["Quantite"]);
                /*
                $article->StockActuel-=$request->Quantite;
                $article->save();

                */

            }

          
        }
            return redirect()->route('ventes.commandes_ventes');


        
    }



    public function  Edit($id){

        $commandeventes=Commandevente::find($id);
        $clients=Client::all();
        $statuts=StatutCommande::all();
   

        return view("Ventes/Commande_Vente/Modifier_CommandeVente", compact("commandeventes","clients","statuts"));


    }

    public function Update(Request $request,$id)
    {

       
       $commandevente=Commandevente::find($id);



 
       $commandevente->update($request->all());

       return redirect(route("ventes.commandes_ventes"));


    }



     public function Supprimer($id)
    {

        return view("Ventes/Commande_Vente/Delete_CommandeVente", compact("id"));

    }



    public function Delete($id)
    {
     

        Commandevente::destroy($id);

        return redirect(route("ventes.commandes_ventes"));
    }


}
