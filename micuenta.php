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
        <h1 data-role="header" data-theme="a">Detalle de mi cuenta.</h1>

        <div data-role="content">
                <ul id="metaList" data-role="listview" data-filter="true" data-divider-theme="d">
                <li class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-d" data-theme="d" data-iconpos="right" data-icon="arrow-r" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperEls="div">
                        <div class="ui-btn-inner ui-li">
                            <div class="ui-btn-text">
                                <div class="ui-li-aside ui-li-desc"><p>Saldo Actual:</p><h1><?php  echo number_format($cuentas[0]->{'actualBalance'},2); ?>&euro;</h1>
                                </div>
                            </div>
                        </div>
                        <h3>Iban:<?php  echo $cuentas[0]->{'iban'}; ?></h3>
                        <h3>Número cuenta:<?php  echo  $cuentas[0]->{'accountNumber'};?></h3>
                    </li>

                </ul>
            </div>
        <div  id="result">
        </div>
</div>
    </body>
</html>