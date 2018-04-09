//--MODELE--

class Pre extends Events {
    constructor() {
        super();
    }
}

//--VUE--

class PreView extends Events {
    constructor() {
        super();
        this.initialize();
    }

    initialize() {
        //gère le clic sur le bouton de validation
        //document.querySelector("#bouton_Creer_Partie").onclick = () =>
            //this.onClickValidation();
    }

    onClickValidation(){
        //ouvre requete xml
        var httpc = new XMLHttpRequest();
        //ouvre le fichier test
        var url = "partie.php";
        //requete post
        httpc.open("POST", url, true);

        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        //récupère les valeurs du formulaire
        let pseudo = document.querySelector("#pseudo").value;
        let confidentialite = document.querySelector("input[name=confident]:checked").value;
        let taille = document.querySelector("input[name=taille]:checked").value;

        // les valeurs sont mises dans une chaine de cratère qu'on va renvoyer en parametre
        var dataString = "jpseudo=" + pseudo
            + "&jconfident=" + confidentialite
            + "&jtaille=" + taille;

        httpc.send(dataString);
        httpc.onreadystatechange = function() { //appelle une fonction quand l'état change
            if(httpc.readyState == 4 && httpc.status == 200) { // complet et sans erreurs
                //affiche le texte de résultat dans l'élément qui a comme id resulat
                document.getElementById("resultat").innerHTML = this.responseText;
            }
        }
    }

}

//--CONTROLLEUR--

class PreController extends Events {
    constructor() {
        super();

        this.model = new Pre();
        this.view = new PreView();

        this.initialize();
    }

    initialize() {
    }

}

let preC = new PreController();
