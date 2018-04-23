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
