function changeColor(coul1, coul2)
        {
          //noir = 1   blanc =2
            var element = 0;
            var i=0;
            document.querySelector("footer").style.backgroundColor = coul1;
            document.querySelector("footer").style.color = coul2;
            element = document.querySelectorAll("nav > ul > li > a");
            for (i = 0 ; i < element.length; i++) 
            {
                element[i].style.color = coul2;
            }
            element = document.querySelectorAll(".onglet li a");
            for (i = 0 ; i < element.length; i++) 
            {
                element[i].style.color = coul2;
            }
            element = document.querySelectorAll(".onglet li:hover a");
            for (i = 0 ; i < element.length; i++) 
            {
                element[i].style.color = coul2;
            }
            element = document.querySelectorAll(".bouton_header");
            for (i = 0 ; i < element.length; i++) 
            {
                element[i].style.backgroundColor = coul1;
            }
            element = document.querySelectorAll(".bouton_header .onglet");
            for (i = 0 ; i < element.length; i++) 
            {
                element[i].style.backgroundColor = coul1;
            }
            element = document.querySelectorAll("fieldset");
            for (i = 0 ; i < element.length; i++) 
            {
                element[i].style.color = coul2;
            }
            element = document.querySelectorAll("legend");
            for (i = 0 ; i < element.length; i++) 
            {
                element[i].style.color = coul2;
            }
            document.querySelector("#global").style.backgroundColor = coul1;
            document.querySelector("#global").style.color = coul2;

        }