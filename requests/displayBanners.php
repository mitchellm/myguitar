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
                        UPDATE
                    </a>
                </td>
                <td>
                    <a href="#">
                        DELETE
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <?php
}
?>