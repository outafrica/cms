$(document).ready(function(){

    $('#selectAll').click(function(event){

        if(this.checked){

            $('.checkBoxes').each(function(){

                this.checked = true;

            });

        }else {

            $('.checkBoxes').each(function(){

                this.checked = false;

            });

        }

    });


    // var div_box = "<div id='load-screen'><div id='loading'></div></div>";
    // $("body").prepend(div_box);

    // $('#load-screen').delay(200).fadeOut(100, function(){

    //     $(this).remove();

    // });

});

function loadOnlineUsers(){

    $.get("functions.php?usersonline=result", function(data){

        $(".online_users").text(data);

    });

}

setInterval(function(){

    loadOnlineUsers();

},500);
