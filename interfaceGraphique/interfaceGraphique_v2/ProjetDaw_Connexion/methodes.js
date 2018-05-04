var regexPseudo = /^[a-zA-Z0-9]+$/;
var tailleMinimalePseudo = 5;
var tailleMaximalePseudo = 15;

var regexMail = "" ;

var regexPassword = /^[a-zA-Z0-9]+$/;
var tailleMinimalePassword = 5;
var tailleMaximalePassword = 15;

// Test format pseudo
function formatPseudo(texte)
{
  if(!regexPseudo.test(texte))
  {
    return false;

  }

  if(texte.length < tailleMinimalePseudo || texte.length > tailleMaximalePseudo)
  {
    return false;
  }

  return true;
}

// Test format email
function formatEmail(texte)
{
  return true;
}

// Test format password
function formatPassword(texte)
{
  if(!regexPassword.test(texte))
  {
    return false;
  }

  if(texte.length < tailleMinimalePassword || texte.length > tailleMaximalePassword)
  {
    return false;
  }

  return true;
}
