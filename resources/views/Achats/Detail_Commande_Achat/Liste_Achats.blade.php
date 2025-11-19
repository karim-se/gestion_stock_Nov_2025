<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<style>
table,th, td {
  border: 1px solid black;
}
table{
        margin-top: 100px;
        margin-left: 250px;
}

    

</style>


<a href="{{ route("achats.create_detail", [$commandeAchat->CommandeAchatID]) }}"
style="display:inline-block; padding:8px 15px; background-color:#006400; color:white; border:none; border-radius:6px; text-decoration:none;">
Ajouter un article à cette commande</a>



<p><strong>Nom Fournisseur :</strong>{{$commandeAchat->fournisseur->NomFournisseur  }}</p>
<p><strong>Etat Commande :</strong>{{$commandeAchat->statut_commande->Statut  }}</p>

<table>
<tr>   

        <th> Nom Article</th>
        <th> Prix Achat</th>
        <th> Quantite</th>
        <th>Modifier</th>
        <th>Supprimer</th>
  
</tr> 

@foreach ( $detaillesCommandes as $detaillesCommande )
<tr>

        <td>{{ $detaillesCommande -> article->NomArticle}}</td>
        <td>{{ $detaillesCommande -> PrixUnitaire}}</td>
        <td>{{ $detaillesCommande -> Quantite}}</td>

      
       <td><a href ="{{ route("achats.edit", [$detaillesCommande->DetailAchatID ] )}}"> Modifier Achat</a></td>
      <td> <a href="{{ route('achats.Supprimer', [$detaillesCommande->CommandeAchatID,$detaillesCommande->DetailAchatID] ) }}" class="button">Supprimer_Achat</a> </td>
       
</tr>
@endforeach
</table>


</body>
</html>