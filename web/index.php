<?php
include_once "../libs/helpers.php";
echo "<body>";
    echo "<div class='wrapper'>";  
    //incluir estilos
    include_once "../view/partials/header.php";
        echo "<div class='main-panel'>"; 
            echo "<div class='container'>";  
                echo "<div class='page-inner'>";  
                    if (isset($_GET['modulo'])) {
                        resolve();
                    } else {
                        redirect(getUrl('Cotizacion','Cotizacion','getResultados'));
                    }
                echo "</div>";  
            echo "</div>"; 

        echo "</div>";  

    echo "</div>";  


    include_once "../view/partials/scripts.php";

echo "</body>";
echo "</html>";