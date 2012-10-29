<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <title>App de ahorro social</title>
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
    </head>
    <body>
<div id="metaListPage" data-role="page">
        <h1 data-role="header" data-theme="a">Acceso a mis ahorros.</h1>

        <form action="./logcredenciales.php" method="post" name="frm_login" id="frm_login">
            <label for="username" data-theme="c">Username:</label>
            <input type="text" name="user" id="user" value="" placeholder="Username"/>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="" placeholder="Password"/>
            <input type='submit' name='submit_login' id="submit_login" value='Login' data-theme="b"/>

        </form>
        <div  id="result">
            <?php
                      if(isset ($_GET['error']))
                        {
                           echo "<p>".$_GET['error']."</p>";
                        }
                ?>

        </div>
</div>
    </body>
</html>