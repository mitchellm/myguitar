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
        ?>
        <form action="?request=newCustomer" method="post">
            <table id="insert">
                <tr>
                    <td>
                        Email Address:
                    </td>
                    <td>
                        <input type="text" name="EmailAddress" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Password:
                    </td>
                    <td>
                        <input type="text" name="Password" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Password Confirmation:
                    </td>
                    <td>
                        <input type="text" name="PasswordConf" />
                    </td>
                </tr>
                <tr>
                    <td>
                        First Name:
                    </td>
                    <td>
                        <input type="text" name="FirstName" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Last Name:
                    </td>
                    <td>
                        <input type="text" name="LastName" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input style="width:100%;" type="submit" name="submit" value="Create" />
                    </td>
                </tr>
            </table>
        </form>
        <?php
    } else {
        $session->register($_POST['EmailAddress'], $_POST['Password'], $_POST['PasswordConf'], $_POST['FirstName'], $_POST['LastName']);
        if ($session->registered) {
            echo "User registered with email: " . $_POST['EmailAddress'] . " and first name " . $_POST['FirstName'];
        }
    }
}
?>