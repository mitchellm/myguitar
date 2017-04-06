<?php
require_once('classes/class.querybuilder.php');

$qry = new QueryBuilder();

$qry->select(array('ItemPrice'))->
        from('orderitems')->
        where('ItemPrice', '=', '1199');
?>
<pre>
<?php
var_dump($qry->retrieve());
?>
</pre>