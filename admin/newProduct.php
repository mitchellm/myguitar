<style type="text/css">
    tr td, tr th { padding: 15px; }
    table { border-collapse: collapse; }
    tr { border: solid thin; }    
    table {
        margin: auto;
        margin-top: 45px;
    }
</style>
<?php
if ($allowAccess) {
    if (!isset($_POST['submit'])) {
        $query = QueryBuilder::getInstance();
        $query->select(array('CategoryName', 'CategoryID'))->from('Categories');
        $categories = $query->get();
        $n = count($categories);
        ?>
        <table>
            <tr>
                <th colspan="2">
                    VALID CATEGORY CODES
                </th>
            </tr>
            <tr>
                <th>
                    CATEGORY
                </th>
                <th>
                    CATEGORY ID
                </th>
            </tr>
            <?php
            for ($i = 0; $i < $n; $i++) {
                ?>
                <tr>
                    <td>
                        <?php echo $categories[$i]['CategoryName']; ?>
                    </td>
                    <td>
                        <?php echo $categories[$i]['CategoryID']; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <form action="?request=newProduct" method="post">
            <table>
                <tr>
                    <td>
                        CategoryID
                    </td>
                    <td>
                        <input type="text" name="CategoryID" />
                    </td>
                </tr>
                <tr>
                    <td>
                        ProductCode
                    </td>
                    <td>
                        <input type="text" name="ProductCode" />
                    </td>
                </tr>
                <tr>
                    <td>
                        ProductName
                    </td>
                    <td>
                        <input type="text" name="ProductName" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Description
                    </td>
                    <td>
                        <input type="text" name="Description" />
                    </td>
                </tr>
                <tr>
                    <td>
                        ListPrice
                    </td>
                    <td>
                        <input type="text" name="ListPrice" />
                    </td>
                </tr>
                <tr>
                    <td>
                        DiscountPerccent
                    </td>
                    <td>
                        <input type="text" name="DiscountPercent" />
                    </td>
                </tr>
                <tr>
                    <td>
                        image
                    </td>
                    <td>
                        <input type="text" name="image" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="< SUBMIT >" style="width:100%;" />
                    </td>
                </tr>
            </table>
        </form>
        <?php
    } else {
        $qry = QueryBuilder::getInstance();
        $qry->insert_into('Products', array('CategoryID' => $_POST['CategoryID'], 'ProductCode' => $_POST['ProductCode'],
            'ProductName' => $_POST['ProductName'], 'Description' => $_POST['Description'], 'ListPrice' => $_POST['ListPrice'],
            'DiscountPercent' => $_POST['DiscountPercent'], 'image' => $_POST['image']));
        $qry->exec();
        echo $qry->retrieve();
        echo "Product inserted.";
    }
}
?>