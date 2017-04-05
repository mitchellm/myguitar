<style type="text/css">
    tr td, tr th {
        padding: 15px;
    }

    table { border-collapse: collapse; }
    tr { border: solid thin; }
</style>
<?php
if ($allowAccess) {
    //array_push($return, array($image, $productid, $productname, $description, $listprice));
    $products = $store->fetchProducts();
    $numProducts = count($products);
    ?>
    <table style="margin:auto; margin-top:50px;">
        <tr>
            <th>
                Image
            </th>
            <th>
                ProductID
            </th>
            <th>
                ProductName
            </th>
            <th>
                Description
            </th>
            <th>
                ListPrice
            </th>
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
                        <?php echo $products[$i][0]; ?>
                    </td>
                    <td>
                        <?php echo $products[$i][1]; ?>
                    </td>
                    <td>
                        <?php echo $products[$i][2]; ?>
                    </td>
                    <td>
                        <?php echo $products[$i][3]; ?>
                    </td>
                    <td>
                        <?php echo $products[$i][4]; ?>
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
            } else {
                if (isset($_POST['email'])) {
                    if ($users[$i]['EmailAddress'] == $_POST['email']) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $users[$i]['FirstName']; ?>
                            </td>
                            <td>
                                <?php echo $users[$i]['LastName']; ?>
                            </td>
                            <td>
                                <?php echo $users[$i]['EmailAddress']; ?>
                            </td>
                            <td>
                                <?php echo $users[$i]['CustomerID']; ?>
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
                } else if (isset($_POST['customerid'])) {
                    if ($users[$i]['CustomerID'] == $_POST['customerid']) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $users[$i]['FirstName']; ?>
                            </td>
                            <td>
                                <?php echo $users[$i]['LastName']; ?>
                            </td>
                            <td>
                                <?php echo $users[$i]['EmailAddress']; ?>
                            </td>
                            <td>
                                <?php echo $users[$i]['CustomerID']; ?>
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
                ?>

                <?php
            }
        }
        ?>
    </table>

    <?php
}
?>