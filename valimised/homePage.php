<?php
require ("../ab_phpLeht/conf.php");
global $yhendus;
// uue nimi lisamine
if(!empty($_REQUEST['uusnimi'])){

    $kask=$yhendus->prepare('INSERT INTO valimised(nimi, lisamiseaeg)
    Values (?, Now())');
    $kask->bind_param('s', $_REQUEST['uusnimi']);
    $kask->execute();
    header:("Location: $_SERVER[PHP_SELF]");
    //$yhendus->close();
}
?>
<!Doctype html>
<html lang="et">
<h1>Home Page</h1>
<head>
    <title>Valimiste leht</title>
</head>
<body>
<h1>Uue nimi lisamine</h1>
<form action="?">
    <input type="text" id="uusnimi" name="uusnimi" placeholder="uus nimi">
    <label for="uusnimi">Nimi</label>
    <input type="submit" value="OK">
</form>

<li><a href="https://pjemeljanov.thkit.ee/phpLehestik/content/valimised/adminPage.php">Admin Page</a></li>
<br>
<li><a href="https://pjemeljanov.thkit.ee/phpLehestik/content/valimised/kasutajaPage.php">Kasutaja Page</a></li>