<style type="text/css">
    tr td, tr th {
        padding: 15px;
    }

    table { border-collapse: collapse; }
    tr { border: solid thin; }
</style>
<?php
if ($allowAccess) {
    if (isset($_POST['add'])) {
        $session->setAdmin($_POST['email']);
    } else if (isset($_POST['delete'])) {
        $session->removeAdmin($_POST['email']);
    }
    //array_push($return, array($image, $productid, $productname, $description, $listprice));
    $admins = $session->getAdmins();
    $numAdmins = count($admins);
    ?>
    <div id="search">
        <table style="margin:auto; margin-top: 30px;">
            <form action="admincp.php?request=manageAdmin" method="post">
                <tr>
                    <td>
                        New Admin Email Address (Must match existing Customer Email): 
                    </td>
                    <td>
                        <input type="text" name="email" style="width:250px;" />
                    </td>
                    <td>
                        <input type="submit" value="Add" name="add" />
                    </td>
                </tr>
            </form> 
        </table>
    </div>
    <table style="margin:auto; margin-top: 30px; text-align: center;" width="60%">
        <tr>
            <th>
                EmailAddress
            </th>
            <th>
                DELETE
            </th>
        </tr>
        <?php
        for ($i = 0; $i < $numAdmins; $i++) {
            ?>
            <tr>
                <td>
                    <?php
                    echo $admins[$i]['EmailAddress'];
                    ?>
                </td>
                <td>
                    <a href="?request=manageAdmin&delete&email=<?php echo $admins[$i]['EmailAddress']; ?>">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <?php
}
?>