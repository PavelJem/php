<?php
$andmed = simplexml_load_file('andmeteBass.xml');


//andmete salvestamine xml faili, kus andmed lisatakse juurde
if(isSet($_POST['submit'])){
    if (!empty(trim($_POST["nimi"])) and !empty(trim($_POST["hind"])) and !empty(trim($_POST["varv"])) and !empty(trim($_POST["lnimi"])) and !empty(trim($_POST["suurus"])))
    {
        $toodenimi = $_POST['nimi'];
        $toodehind = $_POST['hind'];
        $toodevarv = $_POST['varv'];
        $lisanimi = $_POST['lnimi'];
        $suurus = $_POST['suurus'];

        $xml_tooded = $andmed->addChild('toode');
        $xml_tooded->addChild('nimi', $toodenimi);
        $xml_tooded->addChild('hind', $toodehind);
        $xml_tooded->addChild('varv', $toodevarv);

        $lisad = $xml_tooded->addChild('lisad');
        $lisad->addChild('nimi', $lisanimi);
        $lisad->addChild('suurus', $suurus);

        $xmlDoc = new DOMDocument("1.0", "UTF-8");
        $xmlDoc->loadXML($andmed->asXML(), LIBXML_NOBLANKS);
        $xmlDoc->formatOutput = true;
        $xmlDoc->preserveWhiteSpace = false;
        $xmlDoc->save('andmeteBass.xml');
        header("refresh: 0;");
    }
    else
    {
        echo("Sisesta andmed");
    }
}
?>
<?php
if(isset($_POST['submit'])){
    $xmlDoc = new DOMDocument("1.0","UTF-8");
    $xmlDoc->formatOutput = true;
    $xmlDoc->preserveWhiteSpace = false;
}
?>

<?php
if(isset($_POST['submit'])){
    $xmlDoc = new DOMDocument("1.0","UTF-8");
    $xmlDoc->formatOutput = true;
    $xmlDoc->preserveWhiteSpace = false;

    $xml_root = $xmlDoc->createElement("tooted");
    $xmlDoc->appendChild($xml_root);

    $xml_toode = $xmlDoc->createElement("toode");
    $xmlDoc->appendChild($xml_toode);

    $xml_root->appendChild($xml_toode);
}
?>

<?php
  if(isset($_POST['submit'])){
        $xmlDoc = new DOMDocument("1.0","UTF-8");
        $xmlDoc->formatOutput = true;
        $xmlDoc->preserveWhiteSpace = false;

        $xml_root = $xmlDoc->createElement("tooted");
        $xmlDoc->appendChild($xml_root);

        $xml_toode = $xmlDoc->createElement("toode");
        $xmlDoc->appendChild($xml_toode);

        $xml_root->appendChild($xml_toode);

        $xml_toode->appendChild($xmlDoc->createElement('nimetus','muruniiduk'));
        $xml_toode->appendChild($xmlDoc->createElement('kirjeldus','Väga lahe aparaat'));

        $xmlDoc->save('tooted.xml');
    }
?>

<?php
if(isset($_POST['submit'])){
    $xmlDoc = new DOMDocument("1.0","UTF-8");
    $xmlDoc->preserveWhiteSpace = false;
    $xmlDoc->load('tooted.xml');
    $xmlDoc->formatOutput = true;

    $xml_root = $xmlDoc->documentElement;
    $xmlDoc->appendChild($xml_root);

    $xml_toode = $xmlDoc->createElement("toode");
    $xmlDoc->appendChild($xml_toode);

    $xml_root->appendChild($xml_toode);

    $xml_toode->appendChild($xmlDoc->createElement('nimetus','traktor'));
    $xml_toode->appendChild($xmlDoc->createElement('kirjeldus','Põrr põrr põrr'));

    $xmlDoc->save('tooted.xml');
}
?>


<!DOCTYPE html>
<html lang="">
<head>
    <title>XML andmete lugemine PHP abil</title>
</head>
<body>
</body>
<h1>XML andmete lugemine PHP abil</h1>
<h3>Esimese toode nimi:</h3>
<?php
echo $andmed->toode[0]->nimi;
?>
<table>
    <tr>
        <th>Toodenimi</th>
        <th>Hind</th>
        <th>Varv</th>
        <th>Lisade nimi</th>
        <th>Lisade suurus</th>
    </tr>
    <?php
    foreach ($andmed->toode as $toode){
        echo "<tr>";
        echo "<td>".($toode->nimi)."</td>";
        echo "<td>".($toode->hind)."</td>";
        echo "<td>".($toode->varv)."</td>";
        echo "<td>".($toode->lisad->nimi)."</td>";
        echo "<td>".($toode->lisad->suurus)."</td>";
        echo "<tr>";
    }
    ?>
</table>
<h1>Vormist saadud andmete lisamine XML faili</h1>
<form method="post" action="">
    <label for="nimi">Toode nimi</label>
    <input type="text" id="nimi" name="nimi">
    <br>
    <label for="hind">Toode hind</label>
    <input type="text" id="hind" name="hind">
    <br>
    <label for ="varv">Toode varv</label>
    <input type= "text" id="varv" name = "varv">
    <br>
    <label for ="lnimi">Lisad</label>
    <input type= "text" id="lnimi" name = "lnimi">
    <br>
    <label for ="suurus">Suurus</label>
    <input type= "text" id="suurus" name = "suurus">

    <input type ="submit" value="Sisesta" id="submit" name="submit">
</form>
</body>
</html>
