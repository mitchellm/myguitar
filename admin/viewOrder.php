<?php
if ($allowAccess) {
    if (isset($_GET['order'])) {
        $mysqli = $session->getDBC();
        $stmt = $mysqli->prepare("SELECT `LineID`, `OrderID`, `ProductID`, `ItemPrice`, `DiscountAmount`, `Quantity` FROM `orderitems` WHERE `OrderID` = ?");
        $stmt->bind_param("i", $_GET['order']);
        $stmt->bind_result($lineid, $orderid, $productid, $itemprice, $discountamount, $quantity);
        $stmt->execute();
        $items = array();
        while ($stmt->fetch()) {
            $items[] = array($lineid, $orderid, $productid, $itemprice, $discountamount, $quantity);
        }
    } else {
        Utility::redirect("?request=searchOrders");
    }
    ?>
    <style type="text/css">
        tr td, tr th { padding: 15px; }
        table { border-collapse: collapse; }
        tr { border: solid thin; }    
        h2 {
            margin-top:15px;
            text-align:center;
        }
        #order table {
            margin: auto;
            margin-top: 45px;
        }
    </style>
    <h2>Order Contains</h2>
    <div id="order">
        <table>
            <tr>
                <th>
                    LineID
                </th>
                <th>
                    OrderID
                </th>
                <th>
                    ProductID
                </th>
                <th>
                    ItemPrice
                </th>
                <th>
                    DiscountAmount
                </th>
                <th>
                    Quantity
                </th>
            </tr>
            <?php
            $numItems = count($items);
            for ($i = 0; $i < $numItems; $i++) {
                ?>
                <tr>
                    <td>
                        <?php echo $items[$i][0]; ?>
                    </td>
                    <td>
                        <?php echo $items[$i][1]; ?>
                    </td>
                    <td>
                        <?php echo $items[$i][2]; ?>
                    </td>
                    <td>
                        <?php echo $items[$i][3]; ?>
                    </td>
                    <td>
                        <?php echo $items[$i][4]; ?>
                    </td>
                    <td>
                        <?php echo $items[$i][5]; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

<?php } ?>