// Observable pattern with an easy syntax.
class Events {
    constructor() {
        this.handlers = [];
    }

    // Binds each event to the handler.
    // eventDispatcher.on([
    //    {events:"event1", handler:functionName[, context:object]},
    //    {events:"event1 event2", handler:() => console.log("foo")}
    // ]);
    on(eventsArray) {
        let events = this.processEvents(eventsArray);
        events.forEach((event) => {
            let name = event.name;
            let handler = event.handler;
            let context = event.context;

            if (!(name in this.handlers))
                // First time the event is bound to a handler.
                this.handlers[name] = [];

            // handlers is the array of handlers associated with the event
            let handlers = this.handlers[name];

            // The handler is bound to the context :
            // this inside the handler will refer to the bound context
            // and not to the execution context :
            // the object you call dispatch() on.
            handlers.push({handler:handler, context:context});
        });
    }

    // Removes the handler from each event.
    // eventDispatcher.off([
    //    {events:"event1", handler:functionName[, context:object]},
    //    {events:"event1 event2", handler:() => console.log("foo")}
    // ]);
    off(eventsArray) {
        let events = this.processEvents(eventsArray);
        events.forEach((event) => {
            let name = event.name;
            let handler = event.handler;
            let context = event.context;

            // name is not one of the key of this.handlers.
            if (!(name in this.handlers))
                throw new Error(`${name} doesn't have any handler.`);

            // All the handlers associated with the event.
            let handlers = this.handlers[name];

            // Index of the handler in the array : -1 if not present.
            let indexH = handlers.findIndex((h) =>
                (h.handler !== handler) || (h.context !== context) );

            if (indexH < 0) {
                console.log(handler);
                throw new Error(`${handler.name} is not bound to ${name}.`);
            }

            // Removes the handler from the array.
            handlers.splice(indexH, 1);

            if (handlers.length <= 0)
                // Removes the array entry for eventName.
                delete handlers[name];
        });
    }


    // Process the eventsArray and return an array of eventObject
    // [{name:"foo", handler:function(), context:(object|undefined)}, ...]
    processEvents(eventsArray) {
        let processedEvents = [];

        eventsArray.forEach((eventObject) => {
            if (typeof(eventObject.handler) !== "function")
                throw new Error(`${eventObject.handler} is not a function.`);

            // Split the names by whitespaces with a regex.
            eventObject.events.split(/\s+/).forEach((eventName) => {
                processedEvents.push({name:eventName, handler:eventObject.handler, context:eventObject.context});
            });
        });

        return processedEvents;
    }

    // Calls each handler the event is bound to.
    dispatch(event, data) {
        this.handlers[event].forEach(event =>
            // The context is defined as the global one (window) if not provided.
            // let context = (event.context === undefined) ? window : event.context

            // Call the handler with this bound to the context defined,
            // and passes the sender (itself) and the data as arguments to said handler.
            event.handler.call(event.context, this, data));
    }
}

// Here you can see Events applied to MVC.
// Nothing here should be considered as "the right way" to use Events.
// Use it however you want, it's just the observable pattern !
// class Person extends Events {
//     constructor(name) {
//         super();
//
//         this.name = name;
//         this.money = 0;
//
//         this.initialize();
//     }
//
//     initialize() {
//         setInterval(() => this.addMoney(this.money*0.05), 1500);
//     }
//
//     addMoney(amount) {
//         this.money += amount;
//         this.dispatch("moneyAdded");
//     }
//
//     earnInterest() {
//         this.money *= 1.05;
//         this.dispatch("interestEarned");
//     }
// }
//
// class PersonView extends Events {
//     constructor() {
//         super();
//
//         this.initialize();
//     }
//
//     initialize() {
//         this.personDiv = document.createElement("div");
//
//         this.nameP = document.createElement("p");
//         this.personDiv.appendChild(this.nameP);
//
//         this.moneyP = document.createElement("p");
//         this.personDiv.appendChild(this.moneyP);
//
//         this.add1MoneyButton = document.createElement("button");
//         this.add1MoneyButton.innerHTML = "+1$";
//         this.add1MoneyButton.onclick = (() => this.dispatch("add1Money"))
//         this.personDiv.appendChild(this.add1MoneyButton);
//
//         this.add5MoneyButton = document.createElement("button");
//         this.add5MoneyButton.innerHTML = "+5$";
//         this.add5MoneyButton.onclick = (() => this.dispatch("addMoney", 5))
//         this.personDiv.appendChild(this.add5MoneyButton);
//
//         document.body.appendChild(this.personDiv);
//     }
//
//     render(person) {
//         this.nameP.innerHTML = "Name : " + person.name;
//         this.moneyP.innerHTML = "Money : " + person.money.toFixed(2) + "$";
//     }
// }
//
// class PersonController extends Events {
//     constructor() {
//         super();
//
//         this.person = new Person("Picsou");
//         this.personView = new PersonView();
//
//         this.initialize();
//     }
//
//     initialize() {
//         this.person.on([
//             {events:"moneyAdded interestEarned", handler:this.moneyUpdateHandler, context:this}
//         ])
//
//         this.personView.on([
//             {events:"add1Money", handler:() => this.person.addMoney(1), context:this.person},
//             {events:"addMoney", handler:this.addMoneyHandler, context:this}
//         ]);
//
//         this.personView.render(this.person);
//     }
//
//     addMoneyHandler(personView, amount) {
//         if (amount < 0) return;
//
//         this.person.addMoney(amount);
//     }
//
//     moneyUpdateHandler(person) {
//         this.personView.render(person);
//     }
// }
//
// let pC = new PersonController();

// I used this to test Events,
// so it's probably not bug free lol.
// class T extends Events {
//     constructor(valeur) {
//         super();
//
//         this.valeur = valeur;
//         this.childTs = [];
//     }
//
//     createT() {
//         let newT = new T(this.valeur + 1);
//
//         this.on([
//             {events:"event1 event2", handler:this.truc, context:this}
//         ]);
//
//         this.childTs.push(newT);
//     }
//
//     truc(sender, data) {
//         console.log("truc() triggered !");
//         console.log("sender :", sender);
//         console.log(`data :`, data);
//
//         console.log(`valeur du sender :`, sender.valeur);
//         console.log(`valeur du receiver :`, this.valeur);
//         console.log(`this :`, this);
//     }
// }
//
// let t = new T(1);
// t.createT();
// t.createT();
// t.dispatch("event1", "keks");
// console.log("### ###");
// t.off([
//     {events:"event1", handler:t.childTs[0].truc, context:t.childTs[0]}
// ]);
// t.dispatch("event1", "lelz");
