<?php
require_once('classes/class.querybuilder.php');
$qry = QueryBuilder::getInstance();
$qry->select("*")->from("Customers")->where("A", "=", "B");


?>
<pre>
<?php
var_dump($qry->retrieve());
?>
</pre>