<?php
require_once('classes/class.querybuilder.php');

$QB = new QueryBuilder();

$from = "Customers";
$QB->SELECT(array('EmailAddress','CustomerID','Phone'), $from);
echo $QB->WHERE('AddressID', 'LIKE', 'M');

