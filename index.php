<?php
$songs = [
    [
        'id'=>1,
        'title'=>'A lovely song',
        'author'=>'Some Lover',
        'artist'=>'Some Singer'
    ],
    [
        'id'=>2,
        'title'=>'A romantic song',
        'author'=>'Some Romeo',
        'artist'=>'Some rummer'
    ],
    [
        'id'=>3,
        'title'=>'A pop song',
        'author'=>'Some Poper',
        'artist'=>'Some pop band'
    ],
];

$id = 0;
$path = isset($_GET['path']) ? $_GET['path'] : '/';

preg_match('~[A-Z]*/[A-Z]*/(\d+)~i', $path, $matches);

// api/song ?
if(count($matches) == 2) {
    $id = $matches[1];
    $path = 'api/song';
}

switch ($path) {

    case '/':
        break;

    case 'api/songs':
        header('Content-Type: application/json');
        echo json_encode($songs);
        die(0);
        break;

    case 'api/song':
        header('Content-Type: application/json');
        $song = array_filter($songs, function ($song) use ($id) {
            return $song['id'] == $id;
        });

        echo json_encode($song);

        die(0);
        break;

    default:
        $content = 'This is default contents';

}
?>

<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Backbone JS</title>
    <link rel="icon" href="/favicon.png">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/css/normalize.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/styles.css">

    <script src="/js/lib/modernizr-2.6.2.min.js"></script>
</head>
<body>
<ul id="vehicleTemplate">
    <?= $content; ?>
</ul>

<script src="/js/lib/jquery-min.js"></script>
<script src="/js/lib/underscore-min.js"></script>
<script src="/js/lib/backbone-min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
