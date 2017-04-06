<style type="text/css">
    tr td, tr th { padding: 15px; }
    table { border-collapse: collapse; }
    tr { border: solid thin; }
    #search {
        margin-top: 25px;
        text-align: center;
    }
</style>
<?php
if ($allowAccess) {
    $orders = $store->fetchOrders();
    $numOrders = count($orders);
    ?>
    <div id="search">
        <table style="margin:auto; margin-top: 30px;">
            <form action="admincp.php?request=displayOrders" method="post">
                <tr>
                    <td>
                        Search for specific CustomerID (from table, must be exact): 
                    </td>
                    <td>
                        <input type="text" name="customerid" style="width:250px;" />
                    </td>
                    <td>
                        <input type="submit" value="Go" name="submit" />
                    </td>
                </tr>
            </form> 
        </table>
    </div>
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
                        <?php echo $orders[$i]['OrderDate']; ?>
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
                        <a href="?request=viewOrder&order=<?php echo $orders[$i]['OrderID'] ?>">
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
            } else {
                if ($orders[$i]['CustomerID'] == $_POST['customerid']) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $orders[$i]['OrderID']; ?>
                        </td>
                        <td>
                            <?php echo $orders[$i]['CustomerID']; ?>
                        </td>
                        <td>
                            <?php echo $orders[$i]['OrderDate']; ?>
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
                            <a href="#">
                                Click to update
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

    <?php
}
?>