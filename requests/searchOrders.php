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
if (isset($_POST['Search'])) {
    $qry = new QueryBuilder();
    $qry->select("*")->from('Orders');
    foreach ($search_options as $key => $val) {
        $qry->where($key, "LIKE", $val);
    }
    $orders = $qry->get();
    $numOrders = count($orders);
    echo "<center>" . $qry->retrieve() . "</center>";
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
                        <?php echo $orders[$i]['OrderDate']; ?>
                    </td>
                    <td>
                        <?php echo $orders[$i]['ShipAmount']; ?>
                    </td>
                    <td>
                        <?php echo $orders[$i]['TaxAmount']; ?>
                    </td>
                    <td>
                        <?php echo $orders[$i]['ShipDate']; ?>
                    </td>
                    <td>
                        <?php echo $orders[$i]['ShipAddressID']; ?>
                    </td>
                    <td>
                        <?php echo $orders[$i]['CardType']; ?>
                    </td>
                    <td>
                        <?php echo $orders[$i]['CardNumber']; ?>
                    </td>
                    <td>
                        <?php echo $orders[$i]['CardExpires']; ?>
                    </td>
                    <td>
                        <?php echo $orders[$i]['BillingAddressID']; ?>
                    </td>
                    <td>
                        <a href="?request=viewOrder&order=<?php echo $orders[$i]['OrderID'] ?>">
                            VIEW CONTENTS
                        </a>
                    </td>
                    <td>
                        <a href="?request=updateOrders&delete&order=<?php echo $orders[$i]['OrderID'] ?>">
                            DELETE
                        </a>
                    </td>
                </tr>
                <?php
            }
        }
    }
    ?>
</table>
