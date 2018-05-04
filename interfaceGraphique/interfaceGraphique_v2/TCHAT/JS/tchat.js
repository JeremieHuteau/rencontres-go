var url="../PHP/tchatAjax.php";
var lastid = 0;
var timer = setInterval(getMessages,500); 


$(function(){
    $("#tchatForm form").submit(function()
                                {
                                    var message = $("#tchatForm form textarea").val();
                                    $.ajax(
                                    {
                                        data : "action=addMessage&message="+message,
                                        url : url,
                                        type  : "POST",
                                        dataType : "json",
                                        success : function(data)
                                                    {
                                                        clearInterval(timer);
                                                        if(data.erreur=="ok")
                                                        {
                                                            getMessages();
                                                            $("#tchatForm form textarea").val("");
                                                        }
                                                        else
                                                        {
                                                            alert(data.erreur);
                                                        }
                                                        timer = setInterval(getMessages,500); 
                                                    },
                                        error : function(resultat,statut,erreur)
                                        {
                                            alert("Erreur :"+resultat+statut+erreur);
                                        }
                                    },"json");
                                    return false;
                                });
            }
);

function getMessages()
{
    $.ajax(
        {
            data : "action=getMessages&lastid="+lastid,
            url : url,
            type  : "POST",
            dataType : "json",
            success : function(data)
                        {
                            if(data.erreur == "ok")
                            {
                                $("#tchat").append(data.result);
                                lastid = data.lastid;
                            }
                            else
                            {
                                alert(data.erreur);
                            }
                        },
            error : function(resultat,statut,erreur)
            {
                alert("Erreur :"+resultat+statut+erreur);
            }
        },"json");
        return false;
}
