<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
 label, input, button , select, table{
  margin-bottom: 20px; /* Adds 10px of space below each element */
}

</style>
<body>



<form method="POST" action ="{{ route('achats.store') }}" >
     @csrf
   <div>
        <label for ="Fournissuer">Nom Fournisseur</label>
        <select id ="Fournissuer" name ="FournisseurID">
            @foreach ( $fournisseurs as $fournisseur )
                <option value ="{{ $fournisseur-> FournisseurID}}">{{ $fournisseur-> NomFournisseur}}</option>
            @endforeach
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

    <div id="Detailles">
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

   </div>

  

     <button type="button" onclick="Afficher_Articles()">Afficher article</button>
  

<h1> Liste Des articles</h1>

<table id="Liste_Articles" border="1">
    <tr>
        <th>Nom Article</th>
        <th>Prix Unitaire</th>
        <th>Quantite</th>
    </tr>
</table>


 <button type="submit">Enregistrer</button>
</form> 

<script>

let selectedArticles = new Set();    
function Afficher_Articles() {
    let article = document.getElementById("Article");
    let prix = document.getElementById("PrixUnitaire");
    let quantite = document.getElementById("Quantite");

    // Vérifier si l'article est déjà sélectionné
    if (selectedArticles.has(article.value)) {
        alert('Cet article a déjà été sélectionné !');
        return;
    }

    let tr = document.createElement("tr");
    tr.innerHTML = `
        <td>${article.options[article.selectedIndex].text}</td>
        <td>${prix.value}</td>
        <td>${quantite.value}</td>
       
    `;
    document.getElementById("Liste_Articles").appendChild(tr);

    // Ajouter aussi les inputs cachés pour l’envoi à Laravel
    let index = document.querySelectorAll("#Liste_Articles tr").length - 1;
        let hiddenContainer = document.createElement("div");
        hiddenContainer.innerHTML = `
        <input type="hidden" name="articles[${index}][ArticleID]" value="${article.value}">
        <input type="hidden" name="articles[${index}][PrixUnitaire]" value="${prix.value}">
        <input type="hidden" name="articles[${index}][Quantite]" value="${quantite.value}">
    `;
        document.querySelector("form").appendChild(hiddenContainer);

        selectedArticles.add(article.value);

        prix.value = "";
        quantite.value = "";
}





</script>


</body>
</html>