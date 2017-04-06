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
                EmailAddress LIKE:
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