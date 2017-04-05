<style type="text/css">
    tr td, tr th {
        padding: 15px;
    }

    table { border-collapse: collapse; }
    tr { border: solid thin; }
</style>
<?php
if ($allowAccess) {
    $banners = $store->fetchBanners();
    $numBanners = count($banners);
    ?>
    <table style="margin:auto; margin-top:50px;">
        <tr>
            <?php
            foreach ($banners[0] as $key => $val) {
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
        for ($i = 0; $i < $numBanners; $i++) {
            if (!isset($_POST['submit'])) {
                ?>
                <tr>
                    <td>
                        <?php echo $banners[$i]['title']; ?>
                    </td>
                    <td>
                        <?php echo $banners[$i]['body']; ?>
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