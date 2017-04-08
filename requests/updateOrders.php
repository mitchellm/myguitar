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
if (isset($_GET['orderid'])) {
    if (isset($_GET['delete'])) {
        echo "<center>";
        echo "Order " . $_GET['orderid'] . " deleted.";
        echo "</ center>";
    }
} else {
    Utility::redirect("admincp.php?request=searchOrders");
}
?>