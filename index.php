<?php
    require 'Action.php';
    require 'config.php';

    $action = new Action();
    session_start();
    $_SESSION["Npedido"] = $action->check($host,$database,$usuario,$senha,$tabela);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>.:: Alerta pedido ::.</title>
        <script src="jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="jquery-backward-timer.min.js" type="text/javascript"></script>
    </head>
    <body>
        <h1 id="tempo" style="text-align: center;margin-top: 300px"></h1>
        <div id="sound"></div>
        <div id="btn"></div>

        <script type="text/javascript">
            $(document).ready("#button").click(function() {
                $('#sound_action').detach();
                $('#tempo').backward_timer('reset');
                $('#tempo').backward_timer('start');
                $('#button').detach();
            });

            $('#tempo').backward_timer({
                seconds: <?=$tempo?>,
                on_exhausted: function(timer) {
                    var dados = 0;
                    $.ajax({
                        type: "POST",
                        url: "controller.php",
                        data: dados,
                        success:function(data) {
                            if(data == "1"){
                                $('#btn').append( "<button id='button' type='button' style='display:block;margin:0 auto;'>CHEGOU UM PEDIDO NOVO!</button>" );
                                $('#sound').append( "<audio id='sound_action' autoplay loop><source src='assets/beep.mp3' type='audio/mpeg'>Seu navegador não suporta HTML5.</audio>" );
                            }else{
                                $('#tempo').backward_timer('reset');
                                $('#tempo').backward_timer('start');
                            }
                            //alert(data);
                        },
                        error: function (xhr, ajaxOptions, thrownError, data) {
                            alert("erro");
                        }
                    });
                }
            });
            $('#tempo').backward_timer('start');
        </script>
    </body>
</html>