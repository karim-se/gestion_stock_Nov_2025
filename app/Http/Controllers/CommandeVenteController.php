<?PHP

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Client;
use App\Models\StatutCommande;
use App\Models\Commandevente;


use Illuminate\Http\Request;
use App\Models\Detailcommandevente;

class CommandeVenteController
{

    
    public function Ajouter_CommandeVente()
    {


        $articles=Article::all();
        $clients=Client::all();
        $status=StatutCommande::all();

        return view("Ventes/Ajouter_CommandeVente", compact ("clients", "status", "articles"));

    }


    public function Store_CommandeVente(Request $request)
    {
  
          
         $commandevente= Commandevente::create($request->all());

         Detailcommandevente::create(
            [
            "CommandeVenteID"=>$commandevente->CommandeVenteID ,   
            "ArticleID"=>$request->ArticleID,
            "PrixUnitaire"=>$request->PrixUnitaire,
            "Quantite"=>$request->Quantite
            ]
            );



            if ($request->Statut_ID==2)
            {
               
                Article::where('articleID',$request->ArticleID)
                         ->decrement('StockActuel',$request->Quantite);
                /*
                $article->StockActuel-=$request->Quantite;
                $article->save();

                */

            }

          




            return redirect()->route('Articles/Listes_Articles');


        
    }
}