<form id="formulaireConnexion" action="validationConnexion.php" onsubmit="return verificationFormulaireConnexion()" method="POST" >
  <fieldset>
    <legend> Se connecter : </legend>
     <p>Email : </p>
     <input type="email" size="20" maxlength="40" placeholder="Email" id="email_Connexion" required/>
     <p>Mot de passe : </p>
     <input type="password" size="20" maxlength="40" placeholder="Mot de passe" id="mdp_Connexion" required/>
     <p>
       <input type="submit" value="Se connecter" id="bouton_Connexion"/>
     </p>
  </fieldset>
</form>
