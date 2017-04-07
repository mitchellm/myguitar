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
if(isset($_GET['customerid'])) {
    $query = new QueryBuilder();
    $query->select(array('CustomerID', 'EmailAddress', 'FirstName', 'LastName'))->
            from('Customers')->
            where('CustomerID', '=', $_GET['customerid']);
    $result = $query->get();
  
    if(empty($result)) {
        die("No results for customer id " . $_GET['customerid']);
    }
?>
<h3 style="text-align:center;">Updating customer id [<?php echo $result[0]['CustomerID']; ?>]</h3>
<form action="?request=updateCustomers&customerid=<?php echo $result[0]['CustomerID']; ?>" method="post">
    <table style="margin:auto; margin-top:15px;">
        <tr>
            <td>
                CustomerID:
            </td>
            <td>
                <?php echo $result[0]['CustomerID']; ?>
            </td>
            <td>
                EmailAddress
            </td>
            <td>
                <input type="text" value="<?php echo $result[0]['EmailAddress']; ?>" name="EmailAddress" />
            </td>
        </tr>
        <tr>
            <td>
                FirstName:
            </td>
            <td>
                <input type="text" value="<?php echo $result[0]['FirstName']; ?>" name="FirstName" />
            </td>
            <td>
                LastName
            </td>
            <td>
                <input type="text" value="<?php echo $result[0]['LastName']; ?>" name="LastName" />
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="submit" name="submit" value="Save" style="width:100%;"/>
            </td>
        </tr>
    </table>
</form>
<?php
} else {
    if(isset($_POST['submit'])) {
        
    }
    Utility::redirect("admincp.php?request=searchCustomers");
}
?>