<style type="text/css">
    tr td, tr th { padding: 15px; }
    table { border-collapse: collapse; }
    tr { border: solid thin; }    
    #search table {
        margin: auto;
        margin-top: 45px;
    }
</style>
<form id="search" action="?request=searchCustomers" method="post">
    <table>
        <tr>
            <td>
                CardNumber LIKE:
            </td>
            <td>
                <input type="text" name="EmailAddress" />
            </td>
            <td>
                FirstName LIKE:
            </td>
            <td>
                <input type="text" name="FirstName" />
            </td>
        </tr>
        <tr>
            <td>
                LastName LIKE:
            </td>
            <td>
                <input type="text" name="LastName" />
            </td>
            <td>
                EmailAddress LIKE:
            </td>
            <td>
                <input type="text" name="EmailAddress" />
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
    $qry->select("*")->from('Customers');
    foreach($search_options as $key => $val) {
        $qry->where($key, "LIKE", $val);
    }
    $users = $qry->get();
    $numUsers = count($users);
    echo "<center>" . $qry->retrieve() . "</center>";
?>
<table style="margin:auto; margin-top:50px;">
    <tr>
        <?php
        foreach ($users[0] as $key => $val) {
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
            VIEW ADDRESSES
        </th>
        <th>
            Update
        </th>
        <th>
            DELETE
        </th>
        <th>
            MAKE/REMOVE ADMIN
        </th>
    </tr>
    <?php
    for ($i = 0; $i < $numUsers; $i++) {
        if (!isset($_POST['submit'])) {
            ?>
            <tr>
                <td>
                    <?php echo $users[$i]['CustomerID']; ?>
                </td>
                <td>
                    <?php echo $users[$i]['EmailAddress']; ?>
                </td>
                <td>
                    <?php echo $users[$i]['Password']; ?>
                </td>
                <td>
                    <?php echo $users[$i]['FirstName']; ?>
                </td>
                <td>
                    <?php echo $users[$i]['LastName']; ?>
                </td>
                <td>
                    <a href="?request=viewAddresses&customer=<?php echo $users[$i]['CustomerID']; ?>">
                        VIEW ADDRESSES
                    </a>
                </td>
                <td>
                    <a href="?request=updateCustomers&customerid=<?php echo $users[$i]['CustomerID']; ?>">
                        Click to update
                    </a>
                </td>
                <td>
                    <a href="#">
                        Click to delete
                    </a>
                </td>
                <td>
                    <a href="#">
                        <?php
                        if ($session->isAdmin($users[$i]['EmailAddress'])) {
                            ?>
                            <a href="?request=manageAdmin&delete&email=<?php echo $users[$i]['EmailAddress']; ?>">REMOVE ADMIN</a>
                            <?php
                        } else {
                            ?>
                            <a href="?request=manageAdmin&add&email=<?php echo $users[$i]['EmailAddress']; ?>">MAKE ADMIN</a>
                            <?php
                        }
                                ?>
                    </a>
                </td>
            </tr>
            <?php
        }
    }
}
    ?>
</table>
