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
        //affichage par défaut
            this.affichageParties();
        //affichage après choix de la taille
        document.querySelector('select[name="dropdown_taille"]').onclick = () =>
            this.affichageParties();
    }

    affichageParties(){
        //ouvre requete xml
        var httpc = new XMLHttpRequest();
        var url = "recherche.php";
        //requete post
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        //récupère les valeurs
        let liste = document.querySelector("#liste");
        let taille = document.querySelector('select[name="dropdown_taille"]').value;

        // les valeurs sont mises dans une chaine de caractère qu'on va renvoyer en parametre
        var dataString = "jliste=" + liste + "&jtaille=" + taille;

        httpc.send(dataString);
        httpc.onreadystatechange = function() { //appelle une fonction quand l'état change
            if(httpc.readyState == 4 && httpc.status == 200) { // complet et sans erreurs
                //affiche le texte de résultat dans l'élément qui a comme id resulat
                liste.innerHTML = this.responseText;
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
