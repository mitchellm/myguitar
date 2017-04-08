<?php
require_once('classes/class.querybuilder.php');

$array = array('A' => 'B', 'B' => 'C');
$qb = new QueryBuilder();
$qb->insert_into('Products', array('ProductID' => '1', 'Leg' => 'End', 'CREAM' => 'Lord'));
echo $qb->retrieve();

?>
<pre>
<?php
var_dump($qb->clean($array));
?>
</pre>