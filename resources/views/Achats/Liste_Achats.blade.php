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




<table>
<tr>   

        <th> Nom Article</th>
        <th> Prix Achat</th>
        <th> Quantite</th>
        <th>Nom Fournisseur</th>
        <th>Statut Commande</th>
        <th>Modifier</th>
        <th>Supprimer</th>
  
</tr> 

@foreach ( $detaillesCommandes as $detaillesCommande )
<tr>

        <td>{{ $detaillesCommande -> article->NomArticle}}</td>
        <td>{{ $detaillesCommande -> PrixUnitaire}}</td>
        <td>{{ $detaillesCommande -> Quantite}}</td>
        <td>{{$detaillesCommande -> commandeachat->fournisseur->NomFournisseur}}</td>
        <td>{{ $detaillesCommande -> commandeachat->statut_commande->Statut }}</td>
      
       <td><a href ="{{ route("achats.edit", [$detaillesCommande->DetailAchatID ] )}}"> Modifier Achat</a></td>
      <td> <a href="{{ route('achats.Supprimer', [$detaillesCommande->CommandeAchatID,$detaillesCommande->DetailAchatID] ) }}" class="button">Supprimer_Achat</a> </td>
       
</tr>
@endforeach
</table>


</body>
</html>