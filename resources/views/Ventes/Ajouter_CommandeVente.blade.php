<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
label, input, button , select{
  margin-bottom: 10px; /* Adds 10px of space below each element */
}

</style>
<body>
<form method="POST" action="{{ route('Store_CommandeVente') }}">

            @csrf
                <div>

                        <label for="Client" >Nom Client</label>
                        <select id="Client" name="ClientID">
                            @foreach ($clients as $client )
                            <option value="{{$client->ClientID  }}" >{{$client->NomClient}}</option>
                            
                            @endforeach
                            <option></option>

                        </select>

                </div>
                

                <div>
                    <label for="Statut"> Statut Commande</label>
                    <select id ="Statut" name="Statut_ID">
                        @foreach ($status as  $statut)
                        <option value="{{ $statut-> Statut_ID}}">{{ $statut-> Statut}}</option>
                        
                        @endforeach

                    </select>

            </div> 
                


            <div>
                <label for ="Article">Nom Article</label>
                <select id="Article" name="ArticleID">
                        @foreach ($articles as $article )
                                <option value="{{ $article->articleID}}">{{ $article->NomArticle }}</option>
                        
                        @endforeach

                </select>

            </div>


            <div>
                    <label  for="PrixUnitaire">Prix Unitaire</label>
                    <input type="number" id="PrixUnitaire" name="PrixUnitaire">

            </div>


            <div>
                    <label  for="Quantite">Quantite</label>
                    <input type="number" id="Quantite" name="Quantite">

            </div>


            <button type="submit">Enregistrer</button>


            
</form>
</body>
</html>