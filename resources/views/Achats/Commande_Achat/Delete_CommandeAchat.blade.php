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
    <form action ="{{ route('achats.delete_commande', [$id1]) }}" method="POST">
         @csrf
        <input type="hidden" asp-for="articleID" />

       
        <div>
           <h2> Êtes-vous sûr de vouloir supprimer cet achat ?</h2>
            <button type="submit"
               style="display:inline-block; padding:8px 15px; background-color:#006400; color:white; border:none; border-radius:6px; text-decoration:none;">
             Valider</button>
            <a href="{{ route('achats.commande_achats',$id1) }}" 
   style="display:inline-block; padding:8px 15px; background-color:#dc3545; color:white; border:none; border-radius:6px; text-decoration:none;">
   Annuler
</a>


        </div>
    </form>
</body>
</html>