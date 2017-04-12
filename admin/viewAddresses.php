<?php
if ($allowAccess) {
    if (isset($_GET['customer'])) {
        $mysqli = $session->getDBC();
        $stmt = $mysqli->prepare("SELECT `AddressID` FROM `customers_addresses` WHERE `CustomerID` = ?");
        $stmt->bind_param("i", $_GET['customer']);
        $stmt->bind_result($addressid);
        $stmt->execute();
        while ($stmt->fetch()) {
            $address = $addressid;
        }

        $stmt2 = $mysqli->prepare("SELECT `Line1`, `Line2`, `City`, `State`, `ZipCode`, `Phone` FROM `Addresses` WHERE `AddressID` = ?");
        $stmt2->bind_param("i", $address);
        $stmt2->bind_result($line1, $line2, $city, $state, $zipcode, $phone);
        $stmt2->execute();
        $addresses = array();
        while ($stmt2->fetch()) {
            $addresses[] = array($line1, $line2, $city, $state, $zipcode, $phone);
        }
    } else {
        Utility::redirect("?request=searchAddresses");
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
    <h2>Customer [ <?php echo $_GET['customer']; ?> ] has the following addresses</h2>
    <div id="order">
        <table>
            <tr>
                <th>
                    Line1
                </th>
                <th>
                    Line2
                </th>
                <th>
                    City
                </th>
                <th>
                    State
                </th>
                <th>
                    ZipCode
                </th>
                <th>
                    Phone
                </th>
                <th>
                    REMOVE
                </th>
            </tr>
            <?php
            $numAddresses = count($addresses);
            for ($i = 0; $i < $numAddresses; $i++) {
                ?>
                <tr>
                    <td>
                        <?php echo $addresses[$i][0]; ?>
                    </td>
                    <td>
                        <?php echo $addresses[$i][1]; ?>
                    </td>
                    <td>
                        <?php echo $addresses[$i][2]; ?>
                    </td>
                    <td>
                        <?php echo $addresses[$i][3]; ?>
                    </td>
                    <td>
                        <?php echo $addresses[$i][4]; ?>
                    </td>
                    <td>
                        <?php echo $addresses[$i][5]; ?>
                    </td>
                    <td>
                        <a href="#">REMOVE</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

<?php
}?>