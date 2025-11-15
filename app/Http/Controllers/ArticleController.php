<?php 

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;

class ArticleController extends Controller 
{


    public function Liste_Articles () 
    {

        $articles=Article::all();
       

     
        
        
        return view ('Articles/Liste_articles', compact('articles'));
    }


    public function Ajouter_Article()
    {
        $categories=Categorie::all();
        return view ('Articles/Ajouter_Article', compact('categories'));
    }



    public function Store_Article(Request $request)
    {

        Article::create($request->all());

       return redirect()->route('articles.liste_articles');      
    }


    public function edit($id)
    {

       $article = Article::findOrFail($id);
       $categories=Categorie::all();

        return view  ('/Articles/Modifier_Article', compact("article","categories"));
    }


    public function update(Request $request, $id)
    {

        $article = Article::findOrFail($id);

        $article->update($request->all());

        return redirect()->route('articles.liste_articles');   
    }



    
    public function Supprimer($id )
    {

        
         
        return view ("/Articles/Delete_Article", compact("id"));

    }


    public function Delete($id)
    {

        $article=Article::find($id);
        $article->delete();

        Return redirect()->route('articles.liste_articles');  
    }

}

