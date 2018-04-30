
var plateau = null;
var plateauX = 0;
var plateauY = 0;
var plateauW = 0;
var plateauH = 0;

var ligne=null;
var ligneX = 0;
var ligneY = 0;

var nombreLigne=0;
var ecart = 0;
var ecart2 = 0;

var previewPion = null;

var ratio = 60/2283 ;

var marge = 15;

var Xactuel = null;
var Yactuel = null;

var svg;
var suspendID;

function Init()
{
  svg = document.querySelector("svg");
  suspendID = svg.suspendRedraw(5000);

  plateau = document.getElementById("plateau");
  plateau.addEventListener('mousemove', mouvementSouris);
  document.addEventListener('click', clicSouris);
  previewPion = document.getElementById("previewPion");
  previewPion.setAttribute("display","none");
    svg.unsuspendRedraw(suspendID);

  var rect = plateau.getBoundingClientRect(),
  scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
  scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  plateauY = rect.top + scrollTop;
  plateauX = rect.left + scrollLeft;
  plateauW = rect.width;
  plateauH = rect.height;

  lignes = document.querySelectorAll("svg > line");
  nombreLigne = lignes.length/2;

  ligneX = ratio*plateauW;
  ligneY = ratio*plateauH;

  ecart = (plateauW-ligneX*2)/(nombreLigne-1);
  ecart2 = (2283-60)/(nombreLigne -1);
}

function verificationPoserPierre(X,Y)
{
  return {possibilite:true,couleur:"red"};
}

function mouvementSouris(event)
{
  var posX = event.clientX - plateauX - ligneX;
  var posY = event.clientY - plateauY - ligneY;

  // Si souris a peu pres sur le point (+ ou - 2 pixels)
  if( posX>-marge && posY>-marge && (posX%ecart-marge<0 || posX%ecart+marge>ecart) && (posY%ecart-marge<0 || posY%ecart+marge>ecart) )
  {
    var X = Math.round(posX/ecart);
    var Y = Math.round(posY/ecart);

    possibilite= verificationPoserPierre(X,Y);

    if(possibilite["possibilite"])
    {

      previewPion.setAttributeNS(null,"cx",X*ecart2+60);
      previewPion.setAttributeNS(null,"cy",Y*ecart2+60);

      previewPion.setAttribute("display","default");
      previewPion.setAttribute("fill",possibilite["couleur"]);

      Xactuel = X;
      Yactuel = Y;
    }
    else
    {
      previewPion.setAttribute("display","none");
      previewPion.setAttribute("fill","");

      Xactuel = null;
      Yactuel = null;
    }

    svg.unsuspendRedraw(suspendID);
  }
  else
  {
    previewPion.setAttribute("display","none");
    previewPion.setAttribute("fill","");
    svg.unsuspendRedraw(suspendID);

    Xactuel = null;
    Yactuel = null;
  }

}

function clicSouris(event)
{
  if(Xactuel!= null && Yactuel!=null)
  {
    possibilite = verificationPoserPierre(Xactuel,Yactuel);

    if(possibilite["possibilite"])
    {
      var pierre = document.createElementNS("http://www.w3.org/2000/svg","ellipse");
      pierre.setAttribute("fill",possibilite["couleur"]);

      pierre.setAttribute("rx","50");
      pierre.setAttribute("ry","50");

      pierre.setAttributeNS(null,"cx",Xactuel*ecart2+60);
      pierre.setAttributeNS(null,"cy",Yactuel*ecart2+60);

      svg.appendChild(pierre);

      svg.unsuspendRedraw(suspendID);
    }
  }
}
