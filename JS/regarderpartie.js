class Model extends Events {
    constructor() {
        super();
    }
}

class View extends Events {
    constructor() {
        super();
        this.initialize();
    }

    initialize() {
        //affichage après choix de la taille
        document.querySelector('select[name="dropdown_taille"]').onclick = () =>{
            let listerecherche = document.querySelector("#liste");
            let taillerecherche = document.querySelector('select[name="dropdown_taille"]').value;
            this.recherche={liste: listerecherche, taille: taillerecherche};
            this.dispatch("affichageRecherche", this.recherche);
        }
    }

    affichage(text){
        liste.innerHTML = text;
    }

}

class Controller extends Events {
    constructor() {
        super();
        this.model = new Model();
        this.view = new View();
        this.initialize();
    }

    initialize() {
        //gestion de l'affichage de la liste de la recherche
        this.affichageRechercheHandler(this.view, {liste: '<ul id="liste">', taille:0});
        this.view.on([
            {events:"affichageRecherche", handler:this.affichageRechercheHandler, context:this}
        ]);
    }

    affichageRechercheHandler(view, objet) {

        //ouvre requete xml
        let httpc = new XMLHttpRequest();
        let url = "../PHP/rechercherregarder.php";
        //requete post
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // les valeurs sont mises dans une chaine de caractère qu'on va renvoyer en parametre
        var dataString = "jliste=" + objet.liste + "&jtaille=" + objet.taille;
        httpc.send(dataString);
        httpc.onreadystatechange = () => { //appelle une fonction quand l'état change
            if(httpc.readyState == 4 && httpc.status == 200) { // complet et sans erreurs
                //affiche le texte de résultat dans l'élément qui a comme id resulat
                this.view.affichage(httpc.responseText);
            }
        }
    }

}

let control = new Controller();
