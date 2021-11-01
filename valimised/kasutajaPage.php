<?php
require ("../ab_phpLeht/conf.php");
?>
    <head>
        <title>Valimiste leht</title>
    </head>
    <body>
    <h1>Valimiste leht+ kommenteerimine</h1>
    <?php
    //valimiste tabeli sisu vaatamine andmebaasist
    global $yhendus;
    //uuus komm
    if(isSet($_REQUEST['uus_kommentaar'])){
        $kask=$yhendus->prepare('UPDATE valimised SET kommentaarid=CONCAT(kommentaarid, ?) WHERE id=?');
        $kommentlisa=$_REQUEST['komment']."\n";
        $kask->bind_param('si',$kommentlisa, $_REQUEST['uus_kommentaar']);
        $kask->execute();
        header:("Location: $_SERVER[PHP_SELF]");
        //$yhendus->close();
    }

    //Update käsk
    if(isset($_REQUEST["haal"])) {
        $kask = $yhendus->prepare('
        UPDATE valimised SET punktid=punktid + 1 WHERE id=?');
        $kask->bind_param('i', $_REQUEST["haal"]);
        $kask->execute();
    }

    $kask=$yhendus->prepare('SELECT id, nimi, punktid, kommentaarid FROM valimised WHERE avalik=1 order by punktid Desc');
    $kask->bind_result($id, $nimi, $punktid, $kommentaarid);
    $kask->execute();
    echo "<table>";
    echo "<tr><th>Nimi</th><th>Punktid</th><th>Anna oma hääl</th><th>Kommentaarid</th>";

    while($kask->fetch()){
        echo "<tr>";
        echo "<td>".htmlspecialchars($nimi)."</td>";
        echo "<td>".($punktid)."</td>";
        echo "<td><a href='?haal=$id'>Lisa +1 punkt</a></td>";
        echo "<td>".nl2br(htmlspecialchars($kommentaarid))."</td>";
        echo "<td>
<form action='?'>
<input type ='hidden' name='uus_kommentaar' value='$id'>
<input type='text' name='komment'>
<input type='submit' value='Lisa kommentaar'>
</form></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    </body>
    </html>
<?php
$yhendus->close();
?>
<li><a href="https://pjemeljanov.thkit.ee/phpLehestik/content/valimised/homePage.php">Home Page</a></li>
<br>
<li><a href="https://pjemeljanov.thkit.ee/phpLehestik/content/valimised/adminPage.php">Admin Page</a></li>
