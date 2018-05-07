function validationRecuperation()
{
    var lien = document.getElementById("formulaire_recuperation").action;
    $.ajax({
        type : "POST",
        url: lien,
        data: "mail="+document.getElementById("mailRecup").value,
        success : function(data) {
            if(data=="0")
                {
                    alert("Mot de passe modifié");
                }
            else
                {
                    alert("bug");
                }
          
        },
        error: function(resultat,statut,erreur) {
          alert("Erreur d'appel, le formulaire ne peut pas fonctionner"+"\n"+resultat+"\n"+statut+"\n"+erreur);
        }
    });

    return false;
}