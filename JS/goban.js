class Goban extends Events {

    constructor() {
        super();

        Goban.empty = 0;
        Goban.black = 1;
        Goban.white = 2;
    }

    // Returns a string easy to copy/paste into the moves (in the Controller)
    // Just here to make testing easier :p
    exportGoban() {
        let s = "";
        for (var x = 1; x <= this.gobanSize; x++) {
            for (var y = 1; y <= this.gobanSize; y++) {
                if (this.board[x][y] != "empty")
                    s += JSON.stringify(this.board[x][y]) + ",\n";
            }
        }
        return s;
    }

    initialize(goban) {
        let size = goban.size;
        this.gobanSize = size;

        this.moves = [];

        // Creation of empty goban.
        this.board = Array(size);
        for (var x = 1; x <= size; x++) {
            this.board[x] = [];

            for (var y = 1; y <= size; y++) {
                this.board[x][y] = "empty";
            }
        }

        for (let move of goban.moves) {
            this.placeStone({x:move.x, y:move.y, color:move.color});
        }
    }

    // Place a stone if the necessary conditions are met,
    // and modifies the board in consequence.
    placeStone(stone) {
        if (!this.validStone(stone)) return;
        this.board[stone.x][stone.y] = stone;
        this.dispatch("stonePlaced", stone);

        // First we check if enemy stones have been captured.

        // Remove the stones of the adjacentEnemyGroups which have no liberties.
        for (let g of this.adjacentEnemyGroups(stone)) {
            if (!this.hasLiberties(g)) {
                for (let s of g) {
                    this.board[s.x][s.y] = "empty";
                    this.dispatch("stoneRemoved", s);
                }
            }
        }
    }

    /**
     * Returns a list of all the same color stones connected to the stone.
     */
    group(stone) {
        // Breadth First Search
        let queue = [stone];
        let markedStones = [stone];

        while (queue.length > 0) {
            let x = queue.shift();
            let stonesToGroup = this.adjacentStonesColor(x, x.color).filter(
                s => markedStones.includes(s) == false
            );
            for (let s of stonesToGroup) {
                queue.push(s);
                markedStones.push(s);
            }
        }

        return markedStones;
    }

    hasLiberties(group) {
        let libertySum = 0;
        // console.log("hasLiberties() : ", group);
        for (let stone of group) {
            // console.log(stone);
            libertySum += this.adjacentCells(stone).filter(
                c => c == "empty"
            ).length;
            if (libertySum > 0) return true;
        }

        return false;
    }

    liberties(group) {
        let libertyCells = [];



        return libertyCells;
    }

    nbLiberties() {

    }

    // Returns the content of the cells adjacent to a stone.
    adjacentCells(stone) {
        let cells = [];
        for (var x = -1; x <= 1; x++) {
            for (var y = -1; y <= 1; y++) {
                // We just want to check the cells that differ by 1 in one coordinate.
                if (Math.abs(x+y) != 1) continue;

                let xCoord = stone.x + x;
                let yCoord = stone.y + y;
                // Be careful not to go out of bounds !
                if ((xCoord < 1 || xCoord > this.gobanSize) || (yCoord < 1 || yCoord > this.gobanSize)) continue;

                cells.push(this.board[xCoord][yCoord]);
            }
        }

        return cells;
    }

    adjacentStones(stone) {
        return this.adjacentCells(stone).filter(
            s => s != "empty"
        )
    }

    adjacentStonesColor(stone, color) {
        return this.adjacentStones(stone).filter(
            s => s.color == color
        );
    }

    adjacentEnemyGroups(stone) {
        let enemyColor = stone.color == "black" ? "white" : "black";

        let groups = this.adjacentStonesColor(stone, enemyColor).map(
            s => this.group(s));

        return groups;
    }

    /**
     * Returns a boolean.
     */
    validStone(stone) {
        if (this.board[stone.x][stone.y] != "empty") return false;

        if (!this.hasLiberties(this.group(stone))) {

            // for (let g of this.adjacentEnemyGroups(stone)) {
            //     if (this.hasLiberties(g))
            // }
            // if (this.hasLiberties(this.adjacentEnemyGroups(stone)))
            return false;
        }
        return true;
    }


}

class GobanView extends Events {
    constructor() {
        super();
        this.initialize()
    }

    initialize() {
        this.ratio = 60/2283 ;

        this.marge = 15;

        this.svg = document.querySelector("svg");
        this.suspendID = this.svg.suspendRedraw(5000);

        this.previewPion = document.getElementById("previewPion");
        this.previewPion.setAttribute("display","none");

        this.plateau = document.getElementById("plateau");
        this.plateau.addEventListener('mousemove', (e) => this.mousemoveHandler(e));

        document.addEventListener('click', (e) => this.clickHandler(e));


        this.svg.unsuspendRedraw(this.suspendID);

        let rect = this.plateau.getBoundingClientRect();
        let scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        this.plateauY = rect.top + scrollTop;
        this.plateauX = rect.left + scrollLeft;
        this.plateauW = rect.width;
        this.plateauH = rect.height;

        let lignes = document.querySelectorAll("svg > line");
        let nombreLigne = lignes.length/2;

        this.ligneX = this.ratio*this.plateauW;
        this.ligneY = this.ratio*this.plateauH;

        this.ecart = (this.plateauW-this.ligneX*2)/(nombreLigne-1);
        this.ecart2 = (2283-60)/(nombreLigne -1);
    }

    verificationPoserPierre(X,Y) {
        return {possibilite:true,couleur:"red"};
    }

    mousemoveHandler(event) {
        let posX = event.clientX - this.plateauX - this.ligneX;
        let posY = event.clientY - this.plateauY - this.ligneY;

        // Si souris a peu pres sur le point (+ ou - 2 pixels)
        if( posX>-this.marge
        &&  posY>-this.marge
        && (posX%this.ecart-this.marge<0 || posX%this.ecart+this.marge>this.ecart)
        && (posY%this.ecart-this.marge<0 || posY%this.ecart+this.marge>this.ecart) ) {
            let X = Math.round(posX/this.ecart);
            let Y = Math.round(posY/this.ecart);

            let possibilite = this.verificationPoserPierre(X,Y);

            if(possibilite["possibilite"]) {
                this.previewPion.setAttributeNS(null,"cx",X*this.ecart2+60);
                this.previewPion.setAttributeNS(null,"cy",Y*this.ecart2+60);

                this.previewPion.setAttribute("display","default");
                this.previewPion.setAttribute("fill",possibilite["couleur"]);

                this.Xactuel = X;
                this.Yactuel = Y;
            } else {
                this.previewPion.setAttribute("display","none");
                this.previewPion.setAttribute("fill","");

                this.Xactuel = null;
                this.Yactuel = null;
            }

            this.svg.unsuspendRedraw(this.suspendID);
        } else {
            this.previewPion.setAttribute("display","none");
            this.previewPion.setAttribute("fill","");
            this.svg.unsuspendRedraw(this.suspendID);

            this.Xactuel = null;
            this.Yactuel = null;
        }
    }

    clickHandler(event) {
        if(this.Xactuel!= null && this.Yactuel!=null) {
            this.dispatch("gobanClick", {x: this.Xactuel+1, y: this.Yactuel+1});
        }
    }

    placeStone(x, y, color) {
        let pierre = document.createElementNS("http://www.w3.org/2000/svg","ellipse");
        pierre.setAttribute("fill", color);

        pierre.setAttribute("rx","50");
        pierre.setAttribute("ry","50");
        pierre.id = `cell${x}-${y}`;

        pierre.setAttributeNS(null,"cx",(x-1)*this.ecart2+60);
        pierre.setAttributeNS(null,"cy",(y-1)*this.ecart2+60);

        this.svg.appendChild(pierre);

        this.svg.unsuspendRedraw(this.suspendID);
    }

    removeStone(x, y) {
        let cell = document.querySelector(`#cell${x}-${y}`);
        this.svg.removeChild(cell);
    }

}

class GobanController extends Events {
    constructor(taille) {
        super();

        this.taille = taille;

        this.turn = "black";

        this.initialize();
    }

    initialize() {
        this.model = new Goban();
        this.view = new GobanView();

        this.model.on([
            {events:"stonePlaced", handler:this.stonePlacedHandler, context:this},
            {events:"stoneRemoved", handler:this.stoneRemovedHandler, context:this}
        ])

        this.view.on([
            {events:"gobanClick", handler:this.gobanClickHandler, context:this}
        ])

        // Configuration where a white stone should not be able to
        // be put in 6-7 (and live), but is.
        let moves = [
        ]

        // this.view.renderGoban(9);
        this.model.initialize({size: this.taille, moves: moves})
    }

    gobanClickHandler(view, cell) {
        this.model.placeStone({x:cell.x, y:cell.y, color:this.turn});
    }

    stonePlacedHandler(model, stone) {
        this.view.placeStone(stone.x, stone.y, stone.color);
        this.turn = this.turn == "black" ? "white" : "black";
    }

    stoneRemovedHandler(model, stone) {
        this.view.removeStone(stone.x, stone.y);
    }

}
// var goban = new GobanController()


// Initial test configuration

// White should be able to place in 9-9
// {"x":7,"y":9,"color":"white"},
// {"x":8,"y":8,"color":"white"},
// {"x":8,"y":9,"color":"black"},
// {"x":9,"y":7,"color":"white"},
// {"x":9,"y":8,"color":"black"}

// White should not be able to place in 6-7
// {"x":4,"y":6,"color":"black"},
// {"x":5,"y":5,"color":"black"},
// {"x":5,"y":6,"color":"white"},
// {"x":5,"y":7,"color":"black"},
// {"x":6,"y":5,"color":"black"},
// {"x":6,"y":6,"color":"white"},
// {"x":6,"y":8,"color":"black"},
// {"x":7,"y":6,"color":"black"},
// {"x":7,"y":7,"color":"black"}
