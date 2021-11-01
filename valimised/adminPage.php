<?php
require ("../ab_phpLeht/conf.php");
global $yhendus;
//peitmine, avalik=0
if(isset($_REQUEST["peitmine"])) {
    $kask = $yhendus->prepare('
    UPDATE valimised SET avalik=0 WHERE id=?');
    $kask->bind_param('i', $_REQUEST["peitmine"]);
    $kask->execute();
}
//avalikustamine, avalik=1
if(isset($_REQUEST["avamine"])) {
    $kask = $yhendus->prepare('
    UPDATE valimised SET avalik=1 WHERE id=?');
    $kask->bind_param('i', $_REQUEST["avamine"]);
    $kask->execute();
}

if(isset($_REQUEST["nulliks"])) {
    $kask = $yhendus->prepare('
    UPDATE valimised SET punktid= 0 WHERE id=?');
    $kask->bind_param('i', $_REQUEST["nulliks"]);
    $kask->execute();

}

?>
    <!Doctype html>
    <html lang="et">
    <head>
        <title>Haldusleht</title>
    </head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <div id="menyy">
    <h1>Valimisnimede haldus</h1>
    <?php
    //valimiste tabeli sisu vaatamine andmebaasist
    global $yhendus;
    $kask=$yhendus->prepare('
    SELECT id, nimi, avalik, punktid FROM valimised');
    $kask->bind_result($id, $nimi, $avalik, $punktid);
    $kask->execute();
    echo "<table>";
    echo "<tr><th>Nimi</th><th>Seisund</th><th>Tegevus</th><th>Punktid</th><th>Null</th><th>Kustutatime</th>";

    while($kask->fetch()){
        $avatekst="Ava";
        $param="avamine";
        $seisund="Peidetud";
        if($avalik==1){
            $avatekst="Peida";
            $param="peitmine";
            $seisund="Avatud";
        }

        echo "<tr>";
        echo "<td>".htmlspecialchars($nimi)."</td>";
        echo "<td>".($seisund)."</td>";
        echo "<td><a href='?$param=$id'>$avatekst</a></td>";
        echo "<td>$punktid</td>";
        echo "<td><a href='?nulliks=$id'>Nulliks</a></td>";
        echo "<td><a href='$_SERVER[PHP_SELF]?kustutasid=$id'>Kustuta</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    </body>
        <br>
        <li><a href="https://pjemeljanov.thkit.ee/phpLehestik/content/valimised/homePage.php">Home Page</a></li>
        <br>
        <li><a href="https://pjemeljanov.thkit.ee/phpLehestik/content/valimised/kasutajaPage.php">Kasutaja Page</a></li>
    </div>
    </html>
<?php


if (isset($_REQUEST["kustutasid"])) {
    $kask = $yhendus->prepare("DELETE FROM valimised WHERE id=?");
    $kask->bind_param("i", $_REQUEST["kustutasid"]);
    $kask->execute();
}


$yhendus->close();
?>

