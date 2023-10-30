<?php
function dmp($text) {
    echo '<pre>';
    var_dump($text);
    echo '</pre>';
}
function ddmp($text) {
    dmp($text);
    die();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width,initial-scale=1">
    <title>Lumi Vue Boilerplate</title>

    <link href=/css/{{app_css}} rel=preload as=style>
    <link href=/js/{{app_js}} rel=preload as=script>
    <link href=/js/{{vendors_js}} rel=preload as=script>

    <link href=/css/{{app_css}} rel=stylesheet>
</head>

<body>
    <div id=app></div>
    <script src=/js/{{vendors_js}}> </script>
    <script src=/js/{{app_js}}> </script>
</body>
</html>
