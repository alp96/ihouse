/*Fonction d'initialisation d'une requete AJAX*/
function ajax_init(){
	if (window.XMLHttpRequest) {
        xmlhttp= new XMLHttpRequest();
    } else {
        if (window.ActiveXObject)
            try {
                xmlhttp= new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    return NULL;
                }
            }
    }
}


/*Fonction d'envoi d'une requete AJAX*/
function ajax_send(type,url,parametre){
	xmlhttp.open(type,url, true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(parametre);
}


/*Fonction appelée lors d'un clic sur un sujet, qui envoie une requete AJAX pour récuperer les messages liés au sujet*/
function ticket_clic(ticket_number)
{
    ajax_init();	
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            //on refresh le champ "boite message"
            document.getElementById("MessageHint").innerHTML = xmlhttp.responseText;
            //on refresh le titre de "boite message"
            document.getElementById("messageTitle").innerHTML =document.getElementById("ticket_"+ticket_number).innerHTML;
        }
    }
	ajax_send("POST","getMessage.php","ticket="+ticket_number);
}	


/*Fonction appelée lors d'un post de nouveau message, qui envoie une requete AJAX pour archiver le message dans la BDD*/
function post_message() {
	ajax_init();
	xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            //on simule un clic pour recharger la boite message
       		ticket_clic(0);
       	}
    }
    ajax_send("POST","message_post.php","message="+document.getElementById("message").value);
}


/*Fonction appelée lors d'un post de nouveau sujet, qui envoie une requete AJAX pour archiver le sujet dans la BDD*/
function post_sujet() {
	ajax_init();
	xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            //refresh de la page pour recharger la boite sujet
        	location.reload();
        }
    }				
	ajax_send("POST","ticket_post.php","sujet_ticket="+document.getElementById("ticket_inbox").value);
}


/*Fonction appelée lors d'une resolution d'un sujet, qui envoie une requete AJAX pour passer le sujet en "resolu" dans la BDD*/
function resolve_ticket(ticket_number)
{
	if (confirm("Souhaitez-vous classer le sujet en \"résolu\" ?"))
	{
		ajax_init();
		document.getElementById("resolve_ticket_"+ticket_number).innerHTML = "Résolu";
		xmlhttp.onreadystatechange = function ()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
                //on simule un clic pour recharger la boite message
				ticket_clic(0);
			}
		}
		ajax_send("POST","ticket_resolve.php","id_ticket="+ticket_number);
	}
}
