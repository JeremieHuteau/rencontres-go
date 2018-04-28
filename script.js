// Variable liées a l inscription
var formulaireInscription;
var champPseudoInscription;
var champEmailInscription;
var champEmailConfirmationInscription;
var champPasswordInscription;
var champPasswordConfirmationInscription;

// Variables liées a la connexion
var formulaireConnexion;
var champPseudoConnexion;
var champPasswordConnexion;

function Init()
{
  formulaireInscription = document.getElementById("formulaire_inscription");
  champPseudoInscription = document.getElementById("formulaireInscription_Pseudo");
  champEmailInscription = document.getElementById("formulaireInscription_Email");
  champEmailConfirmationInscription = document.getElementById("formulaireInscription_EmailConfirmation");
  champPasswordInscription = document.getElementById("formulaireInscription_Password");
  champPasswordConfirmationInscription = document.getElementById("formulaireInscription_PasswordConfirmation");

  formulaireConnexion = document.getElementById("formulaireConnexion");
  champEmailConnexion = document.getElementById("email_Connexion");
  champPasswordConnexion = document.getElementById("mdp_Connexion");
}

function verificationFormulaireConnexion()
{
  var emailConnexion = champEmailConnexion.value;
  var passwordConnexion = champPasswordConnexion.value;
  var actionFormulaireConnexion = formulaireConnexion.action;

  if(emailConnexion.length=0)
  {
    alert("Veuillez entrer votre adresse mail");
    return false;
  }

  if(passwordConnexion.length=0)
  {
    alert("Veuillez entrer votre mot de passe");
    return false;
  }

  // Si les 2 champs sont renseignés
  $.ajax({
    type : "POST",
    url: actionFormulaireConnexion,
    data: "email="+emailConnexion+"&"+
          "password="+passwordConnexion+"&",
    success : function(data) {
      if(data!=0)
      {
        var message = "Identifiants incorrects : Erreur "+data;
        alert(message);
      }
      else
      {
        alert("Connexion réussie.");
        self.location.href="/~mt177991/";
      }
    },
    error: function(resultat,statut,erreur) {
      alert("Erreur d'appel, le formulaire ne peut pas fonctionner"+"\n"+resultat+"\n"+statut+"\n"+erreur);
    }
  });

  return false;
}

function verificationFormulaireInscription()
{
  var pseudoInscription = champPseudoInscription.value;

  var emailInscription = champEmailInscription.value;
  var emailConfirmationInscription = champEmailConfirmationInscription.value;
  var passwordInscription = champPasswordInscription.value;
  var passwordConfirmationInscription = champPasswordConfirmationInscription.value;
  var actionFormulaireInscription = formulaireInscription.action;

  if(!formatPseudo(pseudoInscription))
  {
    alert("Votre pseudo doit contenir les caractères tralala entre X et Y caractères");
    return false;
  }

  // Si adresse mail mauvais format ERREUR
  if(!formatEmail(emailInscription))
  {
    alert("Votre adresse mail n'est pas au bon format");
    return false;
  }



  // Si adresse mail confirmation mauvais format ERREUR
  if(!formatEmail(emailConfirmationInscription))
  {
    alert("Votre adresse mail n'est pas au bon format");
    return false;
  }

  // Si mot de passe mauvais format ERREUR
  if(!formatPassword(passwordInscription))
  {
    alert("Votre mot de passe doit contenir les caractères tralala entre X et Y caractères");
    return false;
  }

  // Si mot de passe confirmation mauvais format ERREUR
  if(!formatPassword(passwordConfirmationInscription))
  {
    alert("Votre mot de passe doit contenir les caractères tralala entre X et Y caractères");
    return false;
  }

  // Si mot de passe differents ERREUR
  if(passwordInscription != passwordConfirmationInscription)
  {
    alert("Les mots de passe ne correspondent pas");
    return false;
  }

  // Si email differents ERREUR
  if(emailInscription != emailConfirmationInscription)
  {
    alert("L'adresse mail saisie ne correspond pas");
    return false;
  }



  // Si on arrive ici tout s'est bien passé
  // On lance une requete AJAX grace a l action du formulaire
  $.ajax({
    type : "POST",
    url: actionFormulaireInscription,
    data: "pseudo="+pseudoInscription+"&"+
          "email="+emailInscription+"&"+
          "emailConfirmation="+emailConfirmationInscription+"&"+
          "password="+passwordInscription+"&"+
          "passwordConfirmation="+passwordConfirmationInscription,
    success : function(data) {
      if(data!=0)
      {
        var message = "Votre compte n'a pas pu être créé. Erreur "+data;
        alert(message);
      }
      else
      {
        alert("Création de compte réussie. Vous allez recevoir un mail.");
      }
    },
    error: function(resultat,statut,erreur) {
      alert("Erreur d'appel, le formulaire ne peut pas fonctionner"+"\n"+resultat+"\n"+statut+"\n"+erreur);
    }
  });

  return false;
}


