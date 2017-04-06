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
    $query = "SELECT `FirstName`, `LastName`, `EmailAddress`, `CustomerID` FROM `Customers`";
    $init = 0;
    if ($FirstName != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "FirstName LIKE '%{$FirstName}%' ";
        $init++;
    }
    if ($LastName != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "LastName LIKE '%{$LastName}%' ";
        $init++;
    }if ($EmailAddress != "") {
        if ($init > 0) {
            $query = $query . "AND ";
        } else {
            $query = $query . "WHERE ";
        }
        $query = $query . "EmailAddress LIKE '%{$EmailAddress}%' ";
        $init++;
    }
    $stmt = $session->getDBC()->prepare($query);
    $stmt->bind_result($firstname, $lastname, $emailaddress, $customerid);
    $stmt->execute();
    $stmt->store_result();
    $users = array();
    while ($stmt->fetch()) {
        $users[] = array('FirstName' => $firstname, 'LastName' => $lastname, 'EmailAddress' => $emailaddress, 'CustomerID' => $customerid);
    }
    $numUsers = count($users);
    echo "<center>" . $query . "</center>";
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
