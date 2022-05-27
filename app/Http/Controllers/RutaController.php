<?php

namespace App\Http\Controllers;

use App\Models\Calle;
use App\Models\Conductore;
use Illuminate\Http\Request;

class RutaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $basess = 0;
        $streets = Calle::get();
        $conductores = Conductore::get();
        $funciones = new RutaController;

        $pares = array();
        $impares = array();
        $resultado = collect();
        $resultadoPares = collect();


        foreach ($streets as $street) {
            $parImpar = $funciones->parImpar(strlen($street->street));
            switch ($parImpar) {
                case 0:
                    array_push($impares, array($street->street, $parImpar));
                    break;
                case 1:
                    array_push($pares, array($street->street, $parImpar));
                    break;
            }
        }

        foreach ($conductores as $conductor) {
            $longitud = strlen($conductor->nombre);
            $vocales = $funciones->contarVocalesConsonantes($conductor->nombre, $longitud)['vocales'];
            $consonantes = $funciones->contarVocalesConsonantes($conductor->nombre, $longitud)['consonantes'];

            foreach ($pares as $par) {
                $calle = $par[0];
                $boolP = $par[1];
                $basess = $vocales + ($vocales * 0.5);
                $funciones->calculoCincuenta($longitud, $calle, $conductor->nombre, $basess, $resultado);
                $funciones->calculoPares($conductor->nombre, $basess, $pares, $resultado, $resultadoPares);
            }
        }

        dd($resultado, $resultadoPares);

    }

    public function calculoPares($conductor, $basess, $pares, $resultado, $resultadoPares)
    {
        for($i= 0; $i < count($pares); $i++){
            echo $resultado;
            if (!$resultado->contains('calle', $pares[$i][0])) {

                // if (!$resultadoPares->contains('calle', $pares[$i][0]) && !$resultadoPares->contains('calle', $pares[$i][0])) {
                //     $resultadoPares->push(array('calle' => $pares[$i][0], 'conductor' => $conductor, 'ss' => $basess));
                // }
            }
        }
    }

    public function calculoCincuenta($longitud, $calle, $conductor, $ss, $resultado){
        if ($longitud == strlen($calle)) {
            if (strlen($calle) <= 19 && strlen($calle) >= 10) {
                if ($boolP = 1) {
                    $resultado->push(collect(array("calle" => $calle, "conductor" => $conductor, "ss" => $ss)));
                    unset($resultado[1]);
                } else {
                    $basess = 0;
                }
            }
        }
    }

    public function contarVocalesConsonantes($cadena, $longitud)
    {
        $vocales = 0;
        $consonantes = 0;
        $cadena = strtolower($cadena);
        for ($indice = 0; $indice < $longitud; $indice++) {
            if (in_array($cadena[$indice], ["a", "e", "i", "o", "u"])) {
                $vocales++;
            } else {
                $consonantes++;
            }
        }

        return [
            'vocales' => $vocales * 1.5,
            'consonantes' => $consonantes * 1,
        ];
    }

    public function parImpar($numero)
    {
        if (($numero % 2) == 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
