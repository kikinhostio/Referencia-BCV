<?php

/*
Este codigo fue desarrollado para resolver ciertas necesidades, no pretende ser óptimo o seguro
Usalo bajo tu propia responsabilidad
Puedes agregar mas filtado para obtener solo el valor numérico y poder usarlo dento de un sistema que necesite esta referencia de tipo de cambio o ficial
*/

    function capturo( $url )
    {
        $ch = curl_init( $url );
        curl_setopt_array( $ch, [ CURLOPT_CUSTOMREQUEST => "GET", CURLOPT_POST => false, CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false ] );
        $c = curl_exec( $ch );
        curl_close( $ch );

        return $c;
    }

        $content = capturo( "https://bcv.org.ve" );

        $doc = new DOMDocument();

        @$doc->loadHTML( $content );

        $usd = $doc->getElementById( 'dolar' )->nodeValue;
        /*--- Alguito de limpieza ---*/
        $usd = preg_replace( '/[\x00-\x1F\x7F]/' , '' , $usd ); /*elimino caracteres no imprimibles */
        $usd = preg_replace( '/\s+/' , ' ' , $usd ); /* espacios dobles */
        /*--- Alguito de limpieza ---*/

        echo $usd;

        echo "<br>";

        $eur = $doc->getElementById( 'euro' )->nodeValue;
        /*--- Alguito de limpieza ---*/
        $eur = preg_replace( '/[\x00-\x1F\x7F]/' , '' , $eur ); /*elimino caracteres no imprimibles */
        $eur = preg_replace( '/\s+/' , ' ' , $eur ); /* espacios dobles */
        /*--- Alguito de limpieza ---*/

        echo $eur;

?>
