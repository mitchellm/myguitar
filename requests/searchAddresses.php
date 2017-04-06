<style type="text/css">
    tr td, tr th { padding: 15px; }
    table { border-collapse: collapse; }
    tr { border: solid thin; }    
    #search table {
        margin: auto;
        margin-top: 45px;
    }
</style>
<form id="search" action="?request=searchAddresses" method="post">
    <table>
        <tr>
            <td>
                AddressID LIKE:
            </td>
            <td>
                <input type="text" name="AddressID" />
            </td>
            <td>
                Line1 LIKE:
            </td>
            <td>
                <input type="text" name="Line1" />
            </td>
        </tr>
        <tr>
            <td>
                Line2 LIKE:
            </td>
            <td>
                <input type="text" name="Line2" />
            </td>
            <td>
                City LIKE:
            </td>
            <td>
                <input type="text" name="City" />
            </td>
        </tr>
        <tr>
            <td>
                State LIKE:
            </td>
            <td>
                <input type="text" name="State" />
            </td>
            <td>
                ZipCode LIKE:
            </td>
            <td>
                <input type="text" name="ZipCode" />
            </td>
        </tr>
        <tr>
            <td>
                Phone LIKE:
            </td>
            <td>
                <input type="text" name="Phone" />
            </td>
            <td colspan="2">
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
    $query = "SELECT `AddressID`, `Line1`, `Line2`, `City`, `State`, `ZipCode`, `Phone` FROM `Addresses`";
    $init = 0;
    if ($AddressID != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "AddressID LIKE '%{$AddressID}%' ";
        $init++;
    }
    if ($Line1 != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "Line1 LIKE '%{$Line1}%' ";
        $init++;
    }
    if ($Line2 != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "Line2 LIKE '%{$Line2}%' ";
        $init++;
    }
    if ($City != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "City LIKE '%{$City}%' ";
        $init++;
    }
    if ($State != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "State LIKE '%{$State}%' ";
        $init++;
    }
    if ($ZipCode != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "ZipCode LIKE '%{$ZipCode}%' ";
        $init++;
    }
    if ($Phone != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "Phone LIKE '%{$Phone}%' ";
        $init++;
    }
    $stmt = $session->getDBC()->prepare($query);
    $stmt->bind_result($addressid, $line1, $line2, $city, $state, $zipcode, $phone);
    $stmt->execute();
    $stmt->store_result();
    $addresses = array();
    while ($stmt->fetch()) {
        $addresses[] = array('AddressID' => $addressid, 'Line1' => $line1, 'Line2' => $line2, 'City' => $city,
            'State' => $state, 'ZipCode' => $zipcode, 'Phone' => $phone);
    }
    $numAddresses = count($addresses);
    echo "<center>" . $query . "</center>";
?>
<table style="margin:auto; margin-top:50px;">
    <tr>
        <?php
        foreach ($addresses[0] as $key => $val) {
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
            DELETE
        </th>
    </tr>
    <?php
    for ($i = 0; $i < $numAddresses; $i++) {
        if (!isset($_POST['submit'])) {
            ?>
            <tr>
                <td>
                    <?php echo $addresses[$i]['AddressID']; ?>
                </td>
                <td>
                    <?php echo $addresses[$i]['Line1']; ?>
                </td>
                <td>
                    <?php echo $addresses[$i]['Line2']; ?>
                </td>
                <td>
                    <?php echo $addresses[$i]['City']; ?>
                </td>
                <td>
                    <?php echo $addresses[$i]['State']; ?>
                </td>
                <td>
                    <?php echo $addresses[$i]['ZipCode']; ?>
                </td>
                <td>
                    <?php echo $addresses[$i]['Phone']; ?>
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
