<?php
    session_start();
    include("../template/connexionbdd.php");

    
    if(isset($_POST['ticket']))//On verifie que le post contient bien un sujet
    {
        if($_POST['ticket']==0 && isset($_SESSION['dernier_ticket_consulte'])) {
            //Si le post est une simple réactualisation et qu'on connait le dernier sujet consulté, on continu
        }else{
            $reponse = $bdd->query('SELECT id_utilisateur FROM ticket WHERE id_ticket='.$_POST['ticket'].'');
            $donnees = $reponse->fetch();           
            if($donnees['id_utilisateur']==$_SESSION['id_utilisateur'] || $_SESSION['droit_maintenance']==1)
            {
                //Si le client peut consulter le ticket (si il lui appartient ou si il est admin), ticket à afficher => récuperation du post
                $_SESSION['dernier_ticket_consulte']=htmlspecialchars($_POST["ticket"]);
            }
            else
            {
                //Si le ticket n'appartient pas à l'utilisateur, ticket à afficher => plus récent ticket créer
                $reponse = $bdd->query('SELECT id_ticket FROM ticket WHERE id_utilisateur='.$_SESSION['id_utilisateur'].' ORDER BY id_ticket DESC LIMIT 0, 1');
                $donnees = $reponse->fetch();                
                if(isset($donnees['id_ticket']))
                {
                    $_SESSION['dernier_ticket_consulte']=$donnees['id_ticket'];
                }else
                {
                   exit();
                }
            }
        }
    }
    else
    {
        //Si pas de ticket en paramètre, ticket => plus récent ticket
        $reponse = $bdd->query('SELECT id_ticket FROM ticket WHERE id_utilisateur='.$_SESSION['id_utilisateur'].' ORDER BY id_ticket DESC LIMIT 0,1');
        $donnees = $reponse->fetch();
        $_SESSION['dernier_ticket_consulte']=$donnees['id_ticket'];
    }

    /*On envoie le tableau des messages*/
    echo '<table id="tablesujet" class="message_box">
            <thead id="theadsujet">
                <tr>
                    <th>
                        <span id="messageTitle">';

    /*On récupère le nom du sujet et on l'envoie dans le title du tableau*/
    $reponse = $bdd->query('SELECT sujet FROM ticket WHERE id_ticket='.$_SESSION['dernier_ticket_consulte'].'');
    $donnees = $reponse->fetch();
    $reponse->closeCursor();
    echo $donnees["sujet"];
    echo '</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>';

    // Affichage de chaque message (toutes les données du client sont protégées par htmlspecialchars)
   $reponse = $bdd->query('SELECT message, id_utilisateur, date FROM message WHERE id_ticket='.$_SESSION['dernier_ticket_consulte'].' ORDER BY id_message'); //enlevé DESC le 12/01/18 à 17h20
   echo '<div class="speech-wrapper">';    
   if($reponse->rowCount() == 0) {
    echo '  <div class="bubble">
                        <div class="txt">
                            <p class="name">Info</p>
                            Aucun message à afficher<br>
                        </div>
                        <div class="bubble-arrow"></div>
                    </div>';
   }  
    while ($donnees = $reponse->fetch())
    {
        if ($_SESSION['droit_maintenance']==0) { //le client est un user simple

            if($donnees['id_utilisateur']==$_SESSION['id_utilisateur'])
            {
                echo '  <div class="bubble alt">
                            <div class="txt">
                                <p class="name alt">Vous :</p>
                                <p class="message">' . htmlspecialchars($donnees['message']) . '</p><br>
                                <span class="timestamp">' . $donnees['date'] . '</span>
                            </div>
                            <div class="bubble-arrow alt"></div>
                        </div>';
            }else
            {
                echo '  <div class="bubble">
                            <div class="txt">
                                <p class="name">Domisep :</p>
                                <p class="message">' . htmlspecialchars($donnees['message']) . '</p><br>
                                <span class="timestamp">' . $donnees['date'] . '</span>
                            </div>
                            <div class="bubble-arrow"></div>
                        </div>';
            }
        }else{ //Le client est un technicien
            $rep = $bdd->query('SELECT type_compte FROM Utilisateur WHERE id_utilisateur='.$donnees['id_utilisateur'].'');
            $data = $rep->fetch();
            $rep->closeCursor();
            if ($data["type_compte"] != 'Administrateur') {
                $messageclient = 1;
            }
            if ($data["type_compte"] == 'Administrateur' OR $data["type_compte"] == 'Technicien') {
                $messageclient = 0;
            }
            if($messageclient==0)
            {
                echo '  <div class="bubble alt">
                            <div class="txt">
                                <p class="name alt">Technicien n°'.$donnees['id_utilisateur'].'</p>
                                <p class="message">' . htmlspecialchars($donnees['message']) . '</p><br>
                                <span class="timestamp">' . $donnees['date'] . '</span>
                            </div>
                            <div class="bubble-arrow alt"></div>
                        </div>';
            }else
            {
                echo '  <div class="bubble">
                            <div class="txt">
                                <p class="name">Client n°'.$donnees['id_utilisateur'].'</p>
                                <p class="message">' . htmlspecialchars($donnees['message']) . '</p><br>
                                <span class="timestamp">' . $donnees['date'] . '</span>
                            </div>
                            <div class="bubble-arrow"></div>
                        </div>';
            }
        
        }
    }

    /*On récupère la donnée "message resolu ?" dans la BDD*/
    $reponse = $bdd->query('SELECT resolu FROM ticket WHERE id_ticket='.$_SESSION['dernier_ticket_consulte'].'');
    $donnees = $reponse->fetch();
    if($donnees['resolu']==0)
    {
        //Si non résolu, le client peut poster un message
        echo '  <div class="bubble alt">
                    <div class="txt">
                    <p class="name alt">Répondez:<p>
                        <input type="text" id="message" placeholder="Ecrivez ici votre message..." />
                        <input id="button_assistance" type="submit" value="Envoyer" onclick="post_message()" />
                    </div>
                    <div class="bubble-arrow alt"></div>';
    }else
    {
        //si résolu, le client ne peut plus poster de message
        echo '  <div class="bubble">
                    <div class="txt">
                        <p class="name">Info</p>
                        Le sujet est résolu !
                    </div>
                    <div class="bubble-arrow"></div>';
    }                    
    echo '      </div>';
    echo '</div>
            </td>
                </tr>
            </tbody>
        </table>';

    $reponse->closeCursor();
?>
