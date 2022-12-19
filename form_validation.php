<?php
if(!isset($_POST['fullName']) || $_POST['fullName'] == '') {
$error['fullName'] = 'Vul aub uw naam in';
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
$error['email'] = "Verkeerde email format";
}

if(!isset($_POST['email']) || $_POST['email'] == '') {
$error['email'] = 'Vul aub uw email in';
}

if(!isset($_POST['phoneNumber']) || $_POST['phoneNumber'] == '') {
    $error['phoneNumber'] = 'Vul aub uw telefoonnummer in';
}

$dateCheck = explode("-", $_POST['date'], 3);
if (count($dateCheck) < 3 || !checkdate($dateCheck[1], $dateCheck[2], $dateCheck[0])) {
$error['datum'] = 'datum moet in JJJJ-MM-DD formaat';
}

if(!isset($_POST['date']) || $_POST['date'] == '') {
$error['date'] = 'Kies aub een datum';
}

if(!isset($_POST['time']) || $_POST['time'] == '') {
    $error['time'] = 'Kies aub een tijd';
}

if(!isset($_POST['treatment']) || $_POST['treatment'] == '') {
    $error['treatment'] = 'Kies aub een behandeling';
}