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

class DetailCommandeVenteController
{


   public function Liste_Ventes($id){

      $detailecommandesventes=Detailcommandevente::where("CommandeVenteID",$id)->get();
      $commandeventes=Commandevente::find($id);
      

        return View("Ventes/Detail_Commande_Vente/Liste_Ventes", compact("detailecommandesventes","commandeventes"));
   }


    
    public function Create($id)
    {

        $commandevente=Commandevente::find($id);
        $articles=Article::all();
        $clients=Client::all();
        $status=StatutCommande::all();

        return view("Ventes/Detail_Commande_Vente/Ajouter_DetailCommandeVente", compact ("clients", "status", "articles","commandevente"));

    }


    public function Store(Request $request,$id)
    {
  

          foreach ($request->articles as $article) {

        $exists = DetailCommandeVente::where('CommandeVenteID', $id)
            ->where('ArticleID', $article['ArticleID'])
            ->exists();
        if ($exists) {
            $nomArticle=Article::find($article['ArticleID'])->NomArticle;
             return redirect()->back()->with('error', 'L\'article "' . $nomArticle . '" existe déjà dans cette commande.');
        }
    }
       
        
         


         foreach ($request->articles as $article) {

         Detailcommandevente::create(
            [
            "CommandeVenteID"=>$id ,   
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
            return redirect()->route('ventes.liste_ventes',["id"=>$id]);


        
    }



    public function  Edit($id){

        $detailescommandevents=Detailcommandevente::find($id);
        
        $clients=Client::all();
        $statuts=StatutCommande::all();
        $articles=Article::all();

        return view("Ventes/Detail_Commande_Vente/Modifier_DetailCommandeVente", compact("detailescommandevents","clients","statuts","articles"));


    }

    public function Update(Request $request,$id1,$id2)
    {

   

       $detailcommandevente=Detailcommandevente::find($id2);
       



       $detailcommandevente->update($request->all());
     

       return redirect()->route("ventes.liste_ventes", ['id' => $id1]);

    }



     public function Supprimer($id1,$id2)
    {

        return view("Ventes/Detail_Commande_Vente/Delete_DetailCommandeVente", compact("id1", "id2"));

    }



    public function Delete($id1,$id2)
    {

        Detailcommandevente::destroy($id2);

        return redirect(route("ventes.liste_ventes",['id' => $id1]));
    }
}