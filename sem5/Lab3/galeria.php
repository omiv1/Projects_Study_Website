<!DOCTYPE html>
<html>
<head>
    <title>Galeria Zdjec</title>
</head>
<body>
<h1>Galeria Zdjec</h1>

<?php
$miniatury = glob('miniatury/*.jpg');
foreach ($miniatury as $miniatura) {
    $zdjecie = str_replace('miniatury/mini-', '', $miniatura);
    echo '<a href="zdjecia/' . $zdjecie . '" target="_blank"><img src="' . $miniatura . '"></a><br>';
}
?>

<a href="zdjecia2.html">Powrot</a>
</body>
</html>
