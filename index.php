<?php
$songs = [
    [
        'id'=>1,
        'title'=>'A lovely song',
        'author'=>'Some Lover',
        'artist'=>'Some Singer'
    ],
    [
        'id'=>10,
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

$content = 'This is default contents';
$id = 0;
$path = isset($_GET['path']) ? $_GET['path'] : '/';

preg_match('~[A-Z]*/[A-Z]*/(\d+)~i', $path, $matches);

// api/songs/id ?
if(count($matches) == 2) {
    $id = $matches[1];
    $path = 'api/songs';
}

if(rtrim($path, '/') == 'api/songs') {

// find request type
    $requestType = $_SERVER['REQUEST_METHOD'];
    switch ($requestType) {

        case '/':
            break;

        case 'GET':
            header('Content-Type: application/json');
            if ($id == 0) {
                echo json_encode($songs);
            }

        case 'GET':
            header('Content-Type: application/json');
            if ($id > 0) {
                $song = array_filter($songs, function ($song) use ($id) {
                    return $song['id'] == $id;
                });
                $song = empty($song) ? ['id' => 0] : array_shift($song);
                echo json_encode($song);
            }

            break;

        case 'POST':
            header('Content-Type: application/json');
            $song = $_POST['song'];
            // $song = json_decode('{"id": 231, "author": "postmain"}', true);
            $song = json_decode($song, true);

            if (json_last_error() == JSON_ERROR_NONE) {
                $songs[] = $song;
                echo json_encode($songs);
            } else {
                echo json_encode([
                    'error' => json_last_error()
                ]);
            }

            break;

        case 'DELETE':
            header('Content-Type: application/json');
            $id = $_GET['id'];
            foreach ($songs as $index => $song) {
                if ($id = $song['id']) {
                    unset($songs[$index]);
                    break;
                }
            }
            echo json_encode($songs);

            break;

        default:
            // $content = 'This is default contents';
            // showHelp();

    }

    function showHelp()
    {
        echo 'Possible end points are: <br />';
        echo 'GET, POST, DELETE, PUT - api/songs <br />';
    }
} else {
?>

<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Backbone JS - Main</title>
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

<?php } ?>