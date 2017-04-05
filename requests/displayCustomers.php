<style type="text/css">
    tr td, tr th {
        padding: 15px;
    }

    table { border-collapse: collapse; }
    tr { border: solid thin; }
</style>
<?php
if ($allowAccess) {
    $users = $session->getAllUsers();
    $numUsers = count($users);
    ?>
    <div id="search">
        <table style="margin:auto; margin-top: 30px;">
            <form action="admincp.php?request=displayCustomers" method="post">
                <tr>
                    <td>
                        Search for specific Email (from table, must be exact): 
                    </td>
                    <td>
                        <input type="text" name="email" style="width:250px;" />
                    </td>
                    <td>
                        <input type="submit" value="Go" name="submit" />
                    </td>
                </tr>
            </form> 
            <form action="admincp.php?request=displayCustomers" method="post">
                <tr>
                    <td>
                        Search for specific CustomerID (from table, must be exact): 
                    </td>
                    <td>
                        <input type="text" name="customerid" style="width:250px;" />
                    </td>
                    <td>
                        <input type="submit" value="Go" name="submit" />
                    </td>
                </tr>
            </form> 
        </table>
    </div>
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
                Update
            </th>
            <th>
                DELETE
            </th>
        </tr>
        <?php
        for ($i = 0; $i < $numUsers; $i++) {
            if (!isset($_POST['submit'])) {
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