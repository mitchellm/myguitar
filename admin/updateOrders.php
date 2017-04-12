<style type="text/css">
    tr td, tr th { padding: 15px; }
    table { border-collapse: collapse; }
    tr { border: solid thin; }    
    #search table {
        margin: auto;
        margin-top: 45px;
    }
</style>
<?php
if ($allowAccess) {
    if (isset($_GET['order'])) {
        if (isset($_GET['delete'])) {
            $qry = new QueryBuilder();
            $qry->delete_from('Orders')->where('OrderID', '=', $_GET['order']);
            $qry->exec();
            echo "<center>";
            echo "Order " . $_GET['order'] . " deleted.";
            echo "</ center>";
        }
    } else {
        Utility::redirect("admincp.php?request=searchOrders");
    }
}
?>