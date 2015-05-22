$(document).ready(function(){
            $('#error_log_in').hide();
            $('#error_sign_up').hide();
            $('#login_button').click(function(e){
                e.preventDefault();
                var $form = $(this).closest("#login_form");
            //  var formData = $form.serializeArray();
                var login_input_email = $form.find("#login_input_email").val();
                var login_input_password = $form.find("#login_input_password").val();
           //   alert(pass);
                var URL = "proc_log_in.php";
                $.post(URL,
                    {
                        'login_input_email':login_input_email,
                        'login_input_password':login_input_password
                    },
                    function(data, textStatus, jqXHR)
                    {
                //    alert("Data: " + data + "\nStatus: " + textStatus);
                    if(data==1){
                        if(window.location.href.split(/\?|#/)[1]=="logout"){
                            var uri = window.location.href.split(/\?|#/)[0];
                            window.location.href = uri;
                        }else{
                            window.location.reload();
                        }
                        $('#error_log_in').hide();
                     }else{
                        $('#error_log_in').show();
                        $('#error_log_in').html(data);
                     }
                    }).fail(function(jqXHR, textStatus, errorThrown) 
                    {
                 
                    });
            });

            $('#signup_button').click(function(e){
                e.preventDefault();
                var $form = $(this).closest("#signupn_form");
            //  var formData = $form.serializeArray();
                var name = $form.find("#name").val();
                var sirname = $form.find("#sirname").val();
                var email = $form.find("#email").val();
                var password = $form.find("#password").val();
                var re_password = $form.find("#re_password").val();
           //   alert(pass);
                var URL = "proc_sign_up.php";
                $.post(URL,
                    {
                        'name':name,
                        'sirname':sirname,
                        'email':email,
                        'password':password,
                        're_password':re_password
                    },
                    function(data, textStatus, jqXHR)
                    {
                //    alert("Data: " + data + "\nStatus: " + textStatus);
                    if(data==1){
                        if(window.location.href.split(/\?|#/)[1]=="logout"){
                            var uri = window.location.href.split(/\?|#/)[0];
                            window.location.href = uri;
                        }else{
                            window.location.reload();
                        }
                        $('#error_sign_up').hide();
                     }else{
                        $('#error_sign_up').show();
                     }
                    }).fail(function(jqXHR, textStatus, errorThrown) 
                    {
                 
                    });
            });

    $(".like").click(function () {
        var addressValue = $(this).attr("href");
        var span = $(this).find(".badge.like");
      //  alert(name2);
        var id_pns = addressValue.replace("#", "");
        var URL = "proc_like.php";
        $.post(URL,
        {
            'id_pns':id_pns,
            'like':'1',
            'dislike':'0'
        },
        function(data, textStatus, jqXHR)
        {
        //    alert("Data: " + data + "\nStatus: " + textStatus);
            span.text(data);
        }).fail(function(jqXHR, textStatus, errorThrown) 
        {

        });
    });

    $(".dislike").click(function () {
        var span = $(this).find(".badge.dislike");
        var addressValue = $(this).attr("href");
        var id_pns = addressValue.replace("#", "");
        var URL = "proc_like.php";
        $.post(URL,
        {
            'id_pns':id_pns,
            'like':'0',
            'dislike':'1'
        },
        function(data, textStatus, jqXHR)
        {
        //    alert("Data: " + data + "\nStatus: " + textStatus);
            span.text(data);
        }).fail(function(jqXHR, textStatus, errorThrown) 
        {

        });
    });

});