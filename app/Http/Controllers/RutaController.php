<?php

namespace App\Http\Controllers;

use App\Models\Calle;
use App\Models\Conductore;
use App\Models\Resultado;
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
        $resultados = Resultado::get();
        $funciones = new RutaController;
        $pares = array();
        $impares = array();


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
            $basess = $vocales + ($vocales * 0.5);

            foreach ($pares as $par) {
                $calle = $par[0];
                $boolP = $par[1];
                $funciones->calculoCincuenta($longitud, $calle, $conductor->nombre, $basess, $resultados);
            }

            $funciones->calculoPares($conductor->nombre, $basess, $pares, $resultados);
        }

        $dataTabla = $resultados->unique('calle')->unique('conductor')->sortByDesc('basess');

        return view('welcome', compact('dataTabla'));
    }

    public function calculoPares($conductor, $ss, $pares, $resultado)
    {
        for ($i = 0; $i < count($pares); $i++) {
            $calle = $pares[$i][0];
            $data[] = [
                'calle' => $calle, 'conductor' => $conductor, 'ss' => $ss,
            ];
            $consulta = $resultado->where('calle', $calle);

            if ($consulta->count() == 0) {
                Resultado::insert($data);
            } else {
                foreach($consulta as $item) {
                    if ($item->calle != $calle) {
                        Resultado::insert($data);
                        //echo $item->calle . '<br>';
                    }
                }
            }
        }
    }

    public function calculoCincuenta($longitud, $calle, $conductor, $ss, $resultados)
    {
        if ($longitud == strlen($calle)) {
            if (strlen($calle) <= 19 && strlen($calle) >= 10) {
                if ($boolP = 1) {
                    $data[] = [
                        "calle" => $calle, "conductor" => $conductor, "ss" => $ss,
                    ];
                    $consulta = $resultados->where('calle', $calle);
                    if ($consulta->count() == 0) {
                        Resultado::insert($data);
                    } else {
                        foreach ($consulta as $res) {
                            if ($res->ss < $ss) {
                                Resultado::where('calle', $calle)->update(['calle' => $calle, 'conductor' => $conductor, 'ss' => $ss]);
                            }
                        }
                    }
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
