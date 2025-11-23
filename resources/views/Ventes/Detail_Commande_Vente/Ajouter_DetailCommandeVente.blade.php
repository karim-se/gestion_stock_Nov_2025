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
<form method="POST" action="{{ route('ventes.store_detail', [$commandevente->CommandeVenteID]) }}">

        
             
                 @csrf

     @if (session('error'))
    <div style="color:red; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif 

               
                


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

    let selectedArticles = new Set();  
        function Afficher_Article()
        {

           
           let ArticleID = document.getElementById("Article");     
           let NomArticle = document.getElementById("Article").options[document.getElementById("Article").selectedIndex];
          let PrixUnitaire=document.getElementById("PrixUnitaire");
          let Quantite=document.getElementById("Quantite");


          // Vérifier si l'article est déjà sélectionné
    if (selectedArticles.has(ArticleID.value)) {
        alert('Cet article a déjà été sélectionné !');
        return;
    }

          let vente_tr=document.createElement("tr");
          vente_tr.setAttribute("data-article-id", ArticleID.value); // pour identifier l'article
          let NomArticle_td=document.createElement("td");
          let PrixUnitaire_td=document.createElement("td");
          let Quantite_td=document.createElement("td");
          let  supprimbtn=document.createElement("td");
          let actionTd = document.createElement("td");

          NomArticle_td.innerText=NomArticle.text;
          PrixUnitaire_td.innerText=PrixUnitaire.value;
          Quantite_td.innerText=Quantite.value;
          

          // Bouton supprimer
        let btnSuppr = document.createElement("button");
        btnSuppr.type = "button";
        btnSuppr.innerText = "Supprimer";
        btnSuppr.addEventListener("click", function() {
            supprimerArticle(this, ArticleID.value);
        });

        actionTd.appendChild(btnSuppr);

      
          vente_tr.appendChild(NomArticle_td);
          vente_tr.appendChild(PrixUnitaire_td);
          vente_tr.appendChild(Quantite_td);
           vente_tr.appendChild(actionTd);
          

          document.getElementById("Liste_Articles").appendChild(vente_tr);

           let index = document.querySelectorAll("#Liste_Articles tr").length-1;
 
           let hiddenContainer = document.createElement("div");
                hiddenContainer.innerHTML = `
                <input type="hidden" name="articles[${index}][ArticleID]" value="${ArticleID.value}">
                <input type="hidden" name="articles[${index}][PrixUnitaire]" value="${PrixUnitaire.value}">
                <input type="hidden" name="articles[${index}][Quantite]" value="${Quantite.value}">
                `;

                hiddenContainer.classList.add("hidden-article"); 
                document.querySelector("form").appendChild(hiddenContainer);

                selectedArticles.add(ArticleID.value);



               PrixUnitaire.value= "";
               Quantite.value= "";
                 
        }


        function supprimerArticle(button, ArticleID) {
			// Supprimer la ligne du tableau
			let tr = button.closest('tr');
			tr.remove();
			
			// Supprimer les champs cachés correspondants
			let hiddenInputs = document.querySelectorAll(`input[value="${ArticleID}"]`);
			hiddenInputs.forEach(input => {
				if (input.name.includes('[ArticleID]')) {
					let container = input.closest('div');
					container.remove();
				}
			});
			
			// Retirer l'article de la liste des articles sélectionnés
			selectedArticles.delete(ArticleID);
			
			// Recalculer les index des champs cachés restants
			recalculerIndex();
		}

		function recalculerIndex() {
			let rows = document.querySelectorAll("#Liste_Articles tr");
			let hiddenContainers = document.querySelectorAll('form > div'); // Les conteneurs de champs cachés
			
			let index = 0;
			for (let i = 1; i < rows.length; i++) { // Commencer à 1 pour ignorer l'en-tête
				let articleId = rows[i].getAttribute('data-article-id');
				
				// Mettre à jour les champs cachés correspondants
				let correspondingInputs = document.querySelectorAll(`input[value="${articleId}"]`);
				correspondingInputs.forEach(input => {
					if (input.name.includes('[ArticleID]')) {
						input.name = `articles[${index}][ArticleID]`;
					} else if (input.name.includes('[PrixUnitaire]')) {
						input.name = `articles[${index}][PrixUnitaire]`;
					} else if (input.name.includes('[Quantite]')) {
						input.name = `articles[${index}][Quantite]`;
					}
				});
				
				index++;
		}
 }




        
  

</script>


</body>
</html>