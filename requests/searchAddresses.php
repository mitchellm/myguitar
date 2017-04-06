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
$search_options = array();
$fields = array();
foreach ($_POST as $key => $val) {
    if($key == "Search")
        continue;
    $fields[] = $key;
    if($val != "")
        $search_options[$key] = $val;
    
}
if (isset($_POST['Search'])) {
    $qry = new QueryBuilder();
    /**
     * This bit of code removes the last element of the array (the search submit)
     * then moves to 
     */
    
    $qry->select($fields)->from('Addresses');
    foreach($search_options as $key => $val) {
        $qry->where($key, "LIKE", $val);
    }
    $addresses = $qry->get();
    $numAddresses = count($addresses);
    echo "<center>" . $qry->retrieve() . "</center>";
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
                            <a href="#">
                                Click to delete
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }
        }
    }
    ?>
</table>
