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
if (isset($_GET['address'])) {
    if (isset($_GET['delete'])) {
        $qry = new QueryBuilder();
        $qry->delete_from('Addresses')->where('AddressID', '=', $_GET['address']);
        $qry->exec();
        echo "<center>";
        echo "AddressID " . $_GET['address'] . " deleted.";
        echo "</ center>";
    }
} else {
    Utility::redirect("admincp.php?request=searchAddresses");
}
?>