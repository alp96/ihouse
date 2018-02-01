<?php

    //include("../template/connexionbdd.php");
    
    /* Récupération des sujets*/
    if ($_SESSION['droit_maintenance']==0) {
        //si le client est un simple user, on affiche seulement ses messages
        $reponse = $bdd->query('SELECT sujet, date, id_ticket, resolu FROM ticket WHERE id_utilisateur='.$_SESSION['id_utilisateur'].' ORDER BY id_ticket DESC');}
    else{
        //si le client est un admin/technicien, on affiche tous les sujets non-résolus
        $reponse = $bdd->query('SELECT sujet, date, id_ticket, resolu FROM ticket WHERE resolu=0 ORDER BY id_ticket DESC')
    ;}

    // Affichage de chaque sujet dans le tableau des sujets (les sujets sont protégés par htmlspecialchars)
    while ($donnees = $reponse->fetch())
    {
        echo '
                <tr id="lien_ticket_'.$donnees['id_ticket'].'">
                    <td id="ticket_'.$donnees['id_ticket'].'">'.htmlspecialchars($donnees['sujet']).'</td>
                    <td>' .$donnees['date']. '</td>
                    <td id="resolve_ticket_'.$donnees['id_ticket'].'">';

        if($donnees['resolu'])
        {   
            echo "Résolu";
        }else
        {
            echo '  <input id="button_assistance" type="boutton" onClick="resolve_ticket('.$donnees['id_ticket'].')" value="Classer &quot;résolu&quot;" /></td>';
        }
        
        echo '  </tr>';
        echo '<script>';
        echo 'document.getElementById("lien_ticket_'.$donnees['id_ticket'].'").onclick = function() {ticket_clic('.$donnees['id_ticket'].')}';
        echo '</script>';
    }

    $reponse->closeCursor();
?>
