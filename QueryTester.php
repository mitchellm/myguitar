<?php
require_once('classes/class.querybuilder.php');

$qry = new QueryBuilder();
$qry->update('Customers')->set(array('EmailAddress', 'FirstName'), array('bil2l@gmail.com', 'Bill'))->where('CustomerID', '=', '1');
?>
<pre>
<?php
var_dump($qry->exec());
?>
</pre>