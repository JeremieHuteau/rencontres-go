function changeColor()
        {
            var theme = document.getElementById("theme").value;
            var coul1='';
            var coul2='';
            if (theme == "Theme1")
            {
            coul1 = 'black';
            coul2 = 'white';
            }
            if (theme == "Theme2")
            {
            coul1 = 'white';
            coul2 = 'black';
            }
            if (theme == "Theme3")
            {
            coul1 = 'rgb(237,176,95)';
            coul2 = 'black';
            }
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

        function changeCoul(Theme)
        {
            document.getElementById("theme").value = Theme;
            changeColor();
            $.ajax({
                type : "POST",
                url: "changeCouleur.php",
                data: "theme="+Theme,
                success : function(data) 
                {
                 alert(data);
                },
                error: function(resultat,statut,erreur) 
                {
                  alert("Erreur : "+resultat+statut+erreur);
                }
              });
        }