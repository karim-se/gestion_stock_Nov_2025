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



<form method="POST" action ="{{ route('achats.store_detail',[$commandeAchat->CommandeAchatID]) }}" >
     @csrf

     @if (session('error'))
    <div style="color:red; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif



 

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
        <th>Supprimer</th>
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
    tr.setAttribute("data-article-id", article.value); // pour identifier l'article
    tr.innerHTML = `
        <td>${article.options[article.selectedIndex].text}</td>
        <td>${prix.value}</td>
        <td>${quantite.value}</td>
        <td><button type="button" onclick="supprimerArticle(this, '${article.value}')">Supprimer</button></td>
       
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

        hiddenContainer.classList.add("hidden-article"); // pour pouvoir le retrouver
        document.querySelector("form").appendChild(hiddenContainer);

        selectedArticles.add(article.value);

        prix.value = "";
        quantite.value = "";
}

		function supprimerArticle(button, articleId) {
			// Supprimer la ligne du tableau
			let tr = button.closest('tr');
			tr.remove();
			
			// Supprimer les champs cachés correspondants
			let hiddenInputs = document.querySelectorAll(`input[value="${articleId}"]`);
			hiddenInputs.forEach(input => {
				if (input.name.includes('[ArticleID]')) {
					let container = input.closest('div');
					container.remove();
				}
			});
			
			// Retirer l'article de la liste des articles sélectionnés
			selectedArticles.delete(articleId);
			
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