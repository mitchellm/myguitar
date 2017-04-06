<style type="text/css">
    tr td, tr th { padding: 15px; }
    table { border-collapse: collapse; }
    tr { border: solid thin; }    
    #search table {
        margin: auto;
        margin-top: 45px;
    }
</style>
<form id="search" action="?request=searchOrders" method="post">
    <table>
        <tr>
            <td>
                CustomerID EQUALS:
            </td>
            <td>
                <input type="text" name="CustomerID" />
            </td>
            <td>
                CardNumber LIKE:
            </td>
            <td>
                <input type="text" name="CardNumber" />
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="submit" name="Search" value="Search" style="width:100%;" />
            </td>    
        </tr>
    </table>
</form>
<?php
foreach ($_POST as $$key => $val) {
    $$key = htmlspecialchars(mysqli_real_escape_string($session->getDBC(), $val));
}
if (isset($_POST['Search'])) {
    $query = "SELECT `OrderID`, `CustomerID`, `ShipAmount`, `TaxAmount`, `CardNumber` FROM `Orders`";
    $init = 0;
    if ($CardNumber != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "CardNumber LIKE '%{$CardNumber}%' ";
        $init++;
    }
    if ($CustomerID != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "CustomerID LIKE '%{$CustomerID}%' ";
        $init++;
    }
    $stmt = $session->getDBC()->prepare($query);
    $stmt->bind_result($OrderID, $CustomerID, $ShipAmount, $TaxAmount, $CardNumber);
    $stmt->execute();
    $stmt->store_result();
    $orders = array();
    while ($stmt->fetch()) {
        $orders[] = array('OrderID' => $OrderID, 'CustomerID' => $CustomerID, 'ShipAmount' => $ShipAmount, 'TaxAmount' => $TaxAmount, 'CardNumber' => $CardNumber);
    }
    $numOrders = count($orders);
    echo "<center>" . $query . "</center>";
?>
<table style="margin:auto; margin-top:50px;">
    <tr>
        <?php
        foreach ($orders[0] as $key => $val) {
            ?>  
            <th>
                <?php
                echo $key;
                ?>
            </th>
            <?php
        }
        ?>
        <th>
            VIEW CONTENTS
        </th>
        <th>
            DELETE
        </th>
    </tr>
    <?php
    for ($i = 0; $i < $numOrders; $i++) {
        if (!isset($_POST['submit'])) {
            ?>
            <tr>
                <td>
                    <?php echo $orders[$i]['OrderID']; ?>
                </td>
                <td>
                    <?php echo $orders[$i]['CustomerID']; ?>
                </td>
                <td>
                    <?php echo $orders[$i]['ShipAmount']; ?>
                </td>
                <td>
                    <?php echo $orders[$i]['TaxAmount']; ?>
                </td>
                <td>
                    <?php echo $orders[$i]['CardNumber']; ?>
                </td>
                <td>
                    <a href="?request=viewOrder&order=<?php echo $orders[$i]['OrderID']?>">
                        View contents
                    </a>
                </td>
                <td>
                    <a href="#">
                        Click to delete
                    </a>
                </td>
            </tr>
            <?php
        }
    }
}
    ?>
</table>
