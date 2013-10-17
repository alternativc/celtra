<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Celtra Task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Urban" />
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/modernizr.custom.29473.js"></script>
</head>
<body>
<div class="container">
    <header>
        <h1>Celtra Adds</h1>
        <h2>Your adds</h2>
    </header>
    <section class="ac-container" id="adds">

    </section>
</div>
</body>
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script>

    function getAllData(){
        var dataUrl = 'adds/';

        $.getJSON(dataUrl, function(data){
            var counter = 1;
            $.each(data, function(folder, add){
                var html = '<div><input id="ac-' + counter + '" name="accordion-1" type="checkbox" /><label for="ac-' + counter + '">'+ folder +'</label><article class="ac-small"><p>';
                $.each(add, function(){
                    html += '<a href="' + this['url'] + '">' + this['name'] + ' </a><br>';
                });
                html += '</p></article></div>';
                $("#adds").append(html);
                counter++;
            });

        });
    }

    $(document).ready(function(){
        getAllData();
    });
</script>
</html>