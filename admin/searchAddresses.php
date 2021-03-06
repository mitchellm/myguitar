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
if($allowAccess) {
    ?>
<form id="search" action="?request=searchAddresses" method="post">
    <table>
        <tr>
            <td>
                AddressID:
            </td>
            <td>
                <input type="text" name="AddressID" />
            </td>
            <td>
                Line1:
            </td>
            <td>
                <input type="text" name="Line1" />
            </td>
        </tr>
        <tr>
            <td>
                Line2:
            </td>
            <td>
                <input type="text" name="Line2" />
            </td>
            <td>
                City:
            </td>
            <td>
                <input type="text" name="City" />
            </td>
        </tr>
        <tr>
            <td>
                State:
            </td>
            <td>
                <input type="text" name="State" />
            </td>
            <td>
                ZipCode:
            </td>
            <td>
                <input type="text" name="ZipCode" />
            </td>
        </tr>
        <tr>
            <td>
                Phone:
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
if (isset($_POST['Search'])) {
    $qry = QueryBuilder::getInstance();
    $qry->select($fields)->from('Addresses');
    foreach ($search_options as $key => $val) {
        $qry->where($key, "LIKE", $val);
    }
    $addresses = $qry->get();
    $numAddresses = count($addresses);
    echo "<div id=\"qry\">" . $qry->retrieve() . "</div>";
    ?>
    <table style="margin:auto; margin-top:50px;">
        <tr>
            <?php
            if (count($addresses) > 0) {
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
                            <a href="?request=updateAddresses&delete&address=<?php echo $addresses[$i]['AddressID']; ?>">
                                DELETE
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }
        }
    }
}
    ?>
</table>
