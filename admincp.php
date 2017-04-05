<html>
    <head>
        <style type="text/css">
            h1 {
                text-align: center;
                font-size: 36px;
            }

            .navbar {
                margin-top: 10px;
                margin-bottom: 10px;
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

            a:link    {
                /* Applies to all unvisited links */
                text-decoration:  none;
                font-weight:      bold;
                background-color: #ddd;
                color:            blue;
            } 
            a:visited {
                /* Applies to all visited links */
                text-decoration:  none;
                font-weight:      bold;
                background-color: #ddd;
                color:            #f0f;
            } 
            a:hover   {
                /* Applies to links under the pointer */
                text-decoration:  underline;
                font-weight:      bold;
                background-color: blue;
                color:            #fff;
            } 
            a:active  {
                /* Applies to activated links */
                text-decoration:  underline;
                font-weight:      bold;
                background-color: black;
                color: white;
            } 
        </style>
    <h1>Admin Panel</h1>
    <div class="navbar">
        <ul>
            <li> 
                <a href="?request=displayCustomers">
                    Display Customers
                </a>
            </li>
            <li> 
                <a href="?request=displayOrders">
                    Display Orders
                </a>
            </li>
            <li> 
                <a href="?request=displayBanners">
                    Display Banners
                </a>
            </li>
            <li> 
                <a href="?request=displayProducts">
                    Display Products
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar">
        <ul>
            <li> 
                <a href="#">
                    Search Customers
                </a>
            </li>
            <li> 
                <a href="#">
                    Search Orders
                </a>
            </li>
            <li> 
                <a href="#">
                    Search Products
                </a>
            </li>
        </ul>
    </div>
    
    <div class="navbar">
        <ul>
            <li> 
                <a href="?request=manageAdmin">
                    List/Add/Delete Administrators
                </a>
            </li>
        </ul>
    </div>
</head>
<body>
    <div id="content">
    <?php
    require_once 'classes/class.session.php';
    require_once 'classes/class.store.php';
    require_once 'includes/global.php';

    $session = new Session();
    $store = new Store();
    $allowAccess = true;

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

        if (file_exists('requests/' . $command . '.php'))
            include 'requests/' . $command . '.php';
        else
            printf('Error! Command ' . $command . ' not found');
    } else {
        
    }
    ?>
    </div>
</body>
</html>