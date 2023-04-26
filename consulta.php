<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;
ini_set('display_errors',0);
if ($_GET['usr'] && $_GET['ou']){
$domini = 'dc=fjeclot,dc=net';
$opcions = [
 'host' => 'zend-maroma.fjeclot.net',
'username' => "cn=admin,$domini",
 'password' => 'fjeclot',
 'bindRequiresDn' => true,
'accountDomainName' => 'fjeclot.net',
 'baseDn' => 'dc=fjeclot,dc=net',
 ];
$ldap = new Ldap($opcions);
$ldap->bind();
$entrada='uid='.$_GET['usr'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
$usuari=$ldap->getEntry($entrada);
echo "<b><u>".$usuari["dn"]."</b></u><br>";
foreach ($usuari as $atribut => $dada) {
 if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
}
}
//foreach ($usuari as $atribut => $dada) {
//    if ($atribut == "telephoneNumber" || $atribut == "title") {
//        echo $atribut . ": " . $dada[0] . '<br>';
//    }
//}
?>
<html>
<head>
<title>
MOSTRANT DADES D'USUARIS DE LA BASE DE DADES LDAP
</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
<h2>Formulari de selecció d'usuari</h2>
<form action="http://zend-maroma.fjeclot.net/zendldap/consulta.php" method="GET">
Unitat organitzativa: <input type="text" name="ou"><br>
Usuari: <input type="text" name="usr"><br>
<input type="submit"/>
<input type="reset"/>
</form>
<a href="http://zend-maroma.fjeclot.net/zendldap/menu.php">Torna al menú</a>
</body>
</html>