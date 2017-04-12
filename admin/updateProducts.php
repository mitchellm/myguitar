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
if ($allowAccess) {
    if (isset($_GET['product'])) {
        if (isset($_GET['delete'])) {
            $delete = new QueryBuilder();
            $delete->delete_from('Products')->where('ProductID', '=', $_GET['product']);
            $delete->exec();
            echo "<center>";
            echo "Product " . $_GET['product'] . " deleted.";
            echo "</ center>";
        } else {
            $query = new QueryBuilder();
            $query->select(array('ProductID', 'CategoryID', 'ProductCode', 'ProductName',
                        'Description', 'ListPrice', 'DiscountPercent',
                        'DateAdded', 'image'))->
                    from('Products')->
                    where('ProductID', '=', $_GET['product']);
            $result = $query->get();

            if (empty($result)) {
                die("No results for customer id " . $_GET['customerid']);
            }
            ?>
            <h3 style="text-align:center;">Updating product id [<?php echo $result[0]['ProductID']; ?>]</h3>
            <form action="?request=updateProducts&product=<?php echo $result[0]['ProductID']; ?>" method="post">
                <table style="margin:auto; margin-top:15px;">
                    <tr>
                        <td>
                            ProductID:
                        </td>
                        <td>
                            <?php echo $result[0]['ProductID']; ?>
                        </td>
                        <td>
                            CategoryID
                        </td>
                        <td>
                            <?php echo $result[0]['CategoryID']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ProductCode:
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result[0]['ProductCode']; ?>" name="ProductCode" />
                        </td>
                        <td>
                            ProductName
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result[0]['ProductName']; ?>" name="ProductName" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Description:
                        </td>
                        <td colspan="3">
                            <textarea name="Description" style="width:100%; height: 250%;"><?php echo $result[0]['Description']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ListPrice:
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result[0]['ListPrice']; ?>" name="ListPrice" />
                        </td>
                        <td>
                            DiscountPercent
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result[0]['DiscountPercent']; ?>" name="DiscountPercent" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            DateAdded:
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result[0]['DateAdded']; ?>" name="DateAdded" />
                        </td>
                        <td>
                            image
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result[0]['image']; ?>" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="submit" name="submit" value="Update" style="width:100%;" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $column = array();
                $toVal = array();
                foreach ($_POST as $key => $val) {
                    if ($key == "submit")
                        continue;
                    $column[] = $key;
                    $toVal[] = $val;
                }
                $qry = new QueryBuilder();
                $qry->update('Products')->
                        set($column, $toVal)->
                        where('ProductID', '=', $_GET['product']);
                $result = $qry->exec();
                ?>
                <h3 style="text-align: center; margin-top: 20px;">Product <?php echo $_GET['product']; ?> updated... <a href="?request=updateProducts&product=<?php echo $_GET['product']; ?>">Refresh</a></h3>
                <?php
            }
        }
    } else {
        Utility::redirect("admincp.php?request=searchProducts");
    }
}
?>