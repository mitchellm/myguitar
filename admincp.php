<html>
    <head>
        <?php
        require_once 'classes/class.session.php';
        require_once 'classes/class.store.php';
        require_once 'includes/global.php';
        require_once 'classes/class.querybuilder.php';
        require_once('includes/catch_post.php');

        $session = new Session();
        $store = new Store();
        $allowAccess = true;

        if (!$session->isAdministrator())
            if (!$session->isLoggedIn())
                Utility::redirect("login.php");
            else
                die("No permissions to access | Account logged into is NOT listed as administrator in database."
                        . "<br /><a href=\"index.php\">Return home</a>");
        ?>

        <style type="text/css">
            html {
                background-color:DBD6D7;
            }
            h1 {
                text-align: center;
                font-size: 36px;
            }

            .navbar {
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .navbar ul {
                margin: 0;
                padding: 0;
                list-style-type: none;
                text-align: center;
            }

            .navbar ul li {
                display: inline;
                font-size: 22px;
                padding-right: 15px;
                padding-left: 15px;
            }
            a{
                border-radius: 25px;
                padding:5px;
                margin:5px;
            }

            a:link    {
                /* Applies to all unvisited links */
                text-decoration:  none;
                font-weight:      bold;
                background-color: A7A1A2;
                color:           white;
            } 
            a:visited {
                /* Applies to all visited links */
                text-decoration:  none;
                font-weight:      bold;
                background-color: A7A1A2;
                color:            white;
            } 
            a:hover   {
                /* Applies to links under the pointer */
                text-decoration:  none;
                font-weight:      bold;
                background-color: blue;
                color:            #fff;
            } 
            a:active  {
                /* Applies to activated links */
                text-decoration:  underline;
                font-weight:      bold;
                background-color: A7A1A2;
                color: white;
            } 
            input {
                background-color: C9C3C4;
            }
            div#qry::before {
                content: "SQL QUERY = {";
                font-weight:bold;
            }
            
            div#qry::after {
                content: "}";
                font-weight:bold;
            }
            
            div#qry {
                border: 2px solid red;
                padding: 5px;
                text-align: center; 
                width: 60%;
                margin: auto;
            }
        </style>
    <h1>Admin Panel</h1>
    <div class="navbar">
        <ul>
            <li> 
                <a href="?request=displayBanners">
                    Display Banners
                </a>
            </li>
            <li> 
                <a href="?request=manageAdmin">
                    List/Add/Delete Administrators
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar">
        <ul>
            <li> 
                <a href="?request=searchCustomers">
                    Search Customers
                </a>
            </li>
            <li> 
                <a href="?request=searchOrders">
                    Search Orders
                </a>
            </li>
            <li> 
                <a href="?request=searchProducts">
                    Search Products
                </a>
            </li>
            <li> 
                <a href="?request=searchAddresses">
                    Search Addresses
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar">
        <ul>
            <li> 
                <a href="?request=newCustomer">
                    New Customer
                </a>
            </li>
            <li> 
                <a href="?request=newProduct">
                    New Product
                </a>
            </li>
        </ul>
    </div>
</head>
<body>
    <div id="content">
        <?php
        foreach ($_GET as $key => $value) {
            $$key = $_GET[$key];
        }
        foreach ($_POST as $key => $value) {
            $$key = $_POST[$key];
        }

        if (isset($request)) {
            $command = $request;
            $toRemove = array("../", ".php", "/", ".");
            $toReplace = array("", "", "", "");
            $command = str_replace($toRemove, $toReplace, $command);

            if (file_exists('admin/' . $command . '.php'))
                include 'admin/' . $command . '.php';
            else
                printf('Error! Command ' . $command . ' not found');
        } else {
            
        }
        ?>
    </div>
</body>
</html>