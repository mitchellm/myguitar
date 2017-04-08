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
if (isset($_POST['Search'])) {
    $qry = new QueryBuilder();
    $qry->select("*")->from('Products');
    foreach($search_options as $key => $val) {
        $qry->where($key, "LIKE", $val);
    }
    $products = $qry->get();
    $numProducts = count($products);
    echo "<center>" . $qry->retrieve() . "</center>";
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
                        CLICK TO UPDATE
                    </a>
                </td>
                <td>
                    <a href="#">
                        CLICK TO DELETE
                    </a>
                </td>
            </tr>
            <?php
        }
    }
}
    ?>
</table>
