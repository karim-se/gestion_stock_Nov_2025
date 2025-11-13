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



            return redirect()->route('Listes_Articles');


        
    }
}