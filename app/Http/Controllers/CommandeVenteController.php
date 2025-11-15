<?PHP

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\StatutCommande;
use App\Models\Commandevente;


use Illuminate\Http\Request;
use App\Models\Detailcommandevente;
use View;

class CommandeVenteController
{


   public function Liste_Ventes(){

      $detailecommandesventes=Detailcommandevente::all();

        return View("Ventes\Liste_Ventes", compact("detailecommandesventes"));
   }


    
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
            return redirect()->route('ventes.liste_ventes');


        
    }



    public function  Edit($id){

        $detailescommandevents=Detailcommandevente::find($id);
        $clients=Client::all();
        $statuts=StatutCommande::all();
        $articles=Article::all();

        return view("Ventes\Modifier_Vente", compact("detailescommandevents","clients","statuts","articles"));


    }

    public function Update(Request $request,$id)
    {

       $detailcommandevente=Detailcommandevente::find($id);
       $commandevente=Commandevente::find($detailcommandevente->CommandeVenteID);



       $detailcommandevente->update($request->all());
       $commandevente->update($request->all());

       return redirect(route("ventes.liste_ventes"));


    }



     public function Supprimer($id)
    {

        return view("Ventes/Delete_CommandeVente", compact("id"));

    }



    public function Delete($id)
    {

        Detailcommandevente::destroy($id);

        return redirect(route("ventes.liste_ventes"));
    }
}