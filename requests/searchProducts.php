<style type="text/css">
    tr td, tr th { padding: 15px; }
    table { border-collapse: collapse; }
    tr { border: solid thin; }    
    #search table {
        margin: auto;
        margin-top: 45px;
    }
</style>
<form id="search" action="?request=searchProducts" method="post">
    <table>
        <tr>
            <td>
                ProductID LIKE:
            </td>
            <td>
                <input type="text" name="ProductID" />
            </td>
            <td>
                CategoryID LIKE:
            </td>
            <td>
                <input type="text" name="CategoryID" />
            </td>
        </tr>
        <tr>
            <td>
                ProductCode LIKE:
            </td>
            <td>
                <input type="text" name="ProductCode" />
            </td>
            <td>
                ProductName LIKE:
            </td>
            <td>
                <input type="text" name="ProductName" />
            </td>
        </tr>
        <tr>
            <td>
                Description LIKE:
            </td>
            <td>
                <input type="text" name="Description" />
            </td>
            <td>
                ListPrice LIKE:
            </td>
            <td>
                <input type="text" name="ListPrice" />
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
    $query = "SELECT `ProductID`, `CategoryID`, `ProductCode`, `ProductName`, `Description`, `ListPrice`, `DiscountPercent`, `DateAdded`, `image` FROM `Products`";
    $init = 0;
    if ($ProductID != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "ProductID LIKE '%{$ProductID}%' ";
        $init++;
    }
    if ($CategoryID != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "CategoryID LIKE '%{$CategoryID}%' ";
        $init++;
    }if ($ProductCode != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "ProductCode LIKE '%{$ProductCode}%' ";
        $init++;
    }if ($ProductName != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "ProductName LIKE '%{$ProductName}%' ";
        $init++;
    }
    if ($ListPrice != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "ListPrice LIKE '%{$ListPrice}%' ";
        $init++;
    }
    if ($Description != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "Description LIKE '%{$Description}%' ";
        $init++;
    }
    $stmt = $session->getDBC()->prepare($query);
    $stmt->bind_result($productid,$categoryid,$productcode,$productname,$description,$listprice,$discountpercent,$dateadded,$image);
    $stmt->execute();
    $stmt->store_result();
    $products = array();
    while ($stmt->fetch()) {
        $products[] = array('ProductID' => $productid, 'CategoryID' => $categoryid, 'ProductCode' => $productcode, 'ProductName' => $productname,
                'Description' => $description, 'ListPrice' => $listprice, 'DiscountPercent' => $discountpercent, 'DateAdded' => $dateadded, 'image' => $image);
    }
    $numProducts = count($products);
    echo "<center>" . $query . "</center>";
?>
<table style="margin:auto; margin-top:50px;">
    <tr>
        <?php
        foreach ($products[0] as $key => $val) {
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
            Update
        </th>
        <th>
            DELETE
        </th>
    </tr>
    <?php
    for ($i = 0; $i < $numProducts; $i++) {
        if (!isset($_POST['submit'])) {
            ?>
            <tr>
                <td>
                    <?php echo $products[$i]['ProductID']; ?>
                </td>
                <td>
                    <?php echo $products[$i]['CategoryID']; ?>
                </td>
                <td>
                    <?php echo $products[$i]['ProductCode']; ?>
                </td>
                <td>
                    <?php echo $products[$i]['ProductName']; ?>
                </td>
                <td>
                    <?php echo $products[$i]['Description']; ?>
                </td>
                <td>
                    <?php echo $products[$i]['ListPrice']; ?>
                </td>
                <td>
                    <?php echo $products[$i]['DiscountPercent']; ?>
                </td>
                <td>
                    <?php echo $products[$i]['DateAdded']; ?>
                </td>
                <td>
                    <?php echo $products[$i]['image']; ?>
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
