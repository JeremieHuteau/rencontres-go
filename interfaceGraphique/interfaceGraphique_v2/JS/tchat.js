const ajaxTchatUrl = "../PHP/tchatAjax.php";

class TchatView extends Events {
    constructor() {
        super();

        this.form = document.querySelector('#tchatForm');
        this.textArea = document.querySelector('#tchatText');
        this.messageArea = document.querySelector('#tchatForm textarea');

        this.form.onsubmit = (e) => {
            e.preventDefault();
            let contenu = this.messageArea.value;
            this.messageArea.value = "";

            this.dispatch("postMessage", contenu);
        }
    }

    displayMessages(messages) {
        for (let message of messages) {
            let text = `${message.Pseudo} (${message.Horodatage}) : ${message.Contenu}\n`;
            this.textArea.append(text);
        }
        this.textArea.scrollTop = this.textArea.scrollHeight;
    }
}

class TchatController extends Events {
    constructor(partie, tchat) {
        super();

        // No use for a full model here.
        this.partie = partie;
        this.tchat = tchat;
        this.dernierID = -1;

        this.view = new TchatView();

        this.initialize();
    }

    initialize() {
        this.view.on([
            {events:"postMessage", handler:this.postMessageHandler, context:this}
        ]);

        this.getMessages();
        this.messageTimer = setInterval(() => this.getMessages(), 1000);
    }

    postMessageHandler(view, contenu) {
        let xhr = new XMLHttpRequest();


        let queryString = `partie=${this.partie}&tchat=${this.tchat}&contenu=${contenu}`;
        xhr.open('POST', ajaxTchatUrl, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = () => {
            if(xhr.status != 200) console.log("Ajax error : ", xhr.status);
            this.getMessages();       
        }

        xhr.send(queryString);
    }

    getMessages() {
        let xhr = new XMLHttpRequest();

        let queryString = `partie=${this.partie}&tchat=${this.tchat}&after=${this.dernierID}`;
        xhr.open('GET', ajaxTchatUrl+"?"+queryString, true);

        xhr.onload = () => {
            if(xhr.status != 200) console.log("Ajax error : ", xhr.status);

            let messages = JSON.parse(xhr.responseText);

            this.dernierID = messages.map(m => m.ID)
                .reduce((m1, m2) => Math.max(m1, m2), this.dernierID);

            this.view.displayMessages(messages);
        }

        xhr.send();
    }
}

var tchat = new TchatController(2, "Joueur");
