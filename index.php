<?php ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Конвертер валют</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <style>
        label{
            float: left;
            margin-right: 10px;
        }
        input {
            height: 30px;
            font-size: 2em;
        }
        select{
            height: 36px;
        }
        #date{
            padding: 1px;
        }
        #answer{
            font-size: 2em;
        }
    </style>
</head>
<body>

    <form method="post" >
    <label>Дата <br>
        <input id = "date" type = "date" >
    </label>
    <label>Валюта 1  <br>
        <input id = "money" type = "number">
    </label>
    <label>  <br>
        <select id="val1">
            <option>BYN</option>
            <option>RUB</option>
            <option>USD</option>
            <option>EUR</option>
        </select>
    </label>
        <label>
            <h2> > </h2>
        </label>
    <label> Валюта 2 <br>
        <select id = "val2">
            <option>BYN</option>
            <option>RUB</option>
            <option>USD</option>
            <option>EUR</option>
        </select>
    </label>
    </form><br>
    <div id = "answer"></div>
</body>
<script>
    $( document ).ready(function() {
        $(function(){
            $('select').change(function() {
                $current=$(this);
                $("select").not($current).children("option[value='"+$current.val()+"']").attr('disabled', "disabled");
            });
        });
    });

    $(function() {
        $('#money').on('change', function(){
            let date = $('#date').val();
            let money = $('#money').val();
            let val1 = $('#val1').val();
            let val2 = $('#val2').val();
            $.ajax({
                method: "POST",
                url: "functions.php",
                data: {
                    date: date,
                    money: money,
                    val1:val1,
                    val2:val2
                }
            }).success(function(result){
                $("#answer").html( result );
            })
        });
    });
</script>
</html>
