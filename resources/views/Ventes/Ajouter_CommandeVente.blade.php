<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
label, input, button , select, table {
  margin-bottom: 10px; /* Adds 10px of space below each element */
}

</style>
<body>
<form method="POST" action="{{ route('ventes.store') }}">

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

            <button type="button" onclick="Afficher_Article()">Ajouter Article</button>


            <h1>Liste des Articles</h1>

            <table border="1" id="Liste_Articles">
                <tr>
                  <th>Nom Article</th>
                   <th>Prix Unitaire</th>
                   <th>Quantite</th>
                </tr>
            </table>

            <button type="submit">Enregistrer</button>
           
</form>

<script>
        function Afficher_Article()
        {

         
           let ArticleID = document.getElementById("Article");     
           let NomArticle = document.getElementById("Article").options[document.getElementById("Article").selectedIndex];
          let PrixUnitaire=document.getElementById("PrixUnitaire");
          let Quantite=document.getElementById("Quantite");


          let vente_tr=document.createElement("tr");
          let NomArticle_td=document.createElement("td");
          let PrixUnitaire_td=document.createElement("td");
          let Quantite_td=document.createElement("td");

          NomArticle_td.innerText=NomArticle.text;
          PrixUnitaire_td.innerText=PrixUnitaire.value;
          Quantite_td.innerText=Quantite.value;
      
          vente_tr.appendChild(NomArticle_td);
          vente_tr.appendChild(PrixUnitaire_td);
          vente_tr.appendChild(Quantite_td);

          document.getElementById("Liste_Articles").appendChild(vente_tr);

           let index = document.querySelectorAll("#Liste_Articles tr").length-1;
 
           let hiddenContainer = document.createElement("div");
                hiddenContainer.innerHTML = `
                <input type="hidden" name="articles[${index}][ArticleID]" value="${ArticleID.value}">
                <input type="hidden" name="articles[${index}][PrixUnitaire]" value="${PrixUnitaire.value}">
                <input type="hidden" name="articles[${index}][Quantite]" value="${Quantite.value}">
                `;
                document.querySelector("form").appendChild(hiddenContainer);


               PrixUnitaire.value= "";
               Quantite.value= "";
                
           

        }
  

</script>


</body>
</html>