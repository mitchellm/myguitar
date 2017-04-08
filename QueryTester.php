<?php
require_once('classes/class.querybuilder.php');

$array = array('A' => 'B', 'B' => 'C');
$qb = new QueryBuilder();

?>
<pre>
<?php
var_dump($qb->clean($array));
?>
</pre>