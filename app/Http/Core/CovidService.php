<?php

namespace App\Http\Core;

use Illuminate\Support\Facades\Http;

class CovidService implements RestService
{
    private static $url = "https://api.covid19api.com/country/brazil/status/confirmed"; 

    public static function getCovidData() {
        $response = Http::get(self::$url);

        return $response->json();
    }

    private static function formatCovidCases($datas) {
        $covid_cases = [];

        foreach($datas as $period => $cases) {
            list($year, $month) = explode("-", $period);

            if(!isset($covid_cases[$year])) {
                $covid_cases[$year] = [];
            }

            $covid_cases[$year][] = [
                "month" => $month, 
                "total" => $cases, 
            ];
        }

        return $covid_cases;
    }

    public static function getCovidCases() {
        $period = [];
        $result = [];
        $stime  = "";

        $covid_data = self::getCovidData();

        foreach($covid_data as $data) {

            # Separa ano/mês para agrupar dados 
            $ym = date("Y-m", strtotime($data["Date"]));

            # Inicializa array para armazenar casos do período ano/mês
            if(!isset($period[$ym])) {
                $period[$ym] = [];
                $stime = 0;
            }

            # Armazena somente o último registro de casos de cada mês
            if(strtotime($data["Date"]) > $stime) {
                $stime = strtotime($data["Date"]);
                $period[$ym] = $data["Cases"];
            }
        }

        # Cálculo de casos ano/mês. Exe: 2020-01, 2021-01...
        foreach($period as $ym => $cases) {
            $prev_ym = date('Y-m', strtotime("-1 months", strtotime("$ym-01")));
    
            # Subtraí a quantidade de casos do mês conrrente com a do mês anterior
            if(isset($period[$prev_ym])) {
                $result[$ym] = $period[$ym] - $period[$prev_ym];
            } else {
                $result[$ym] = $period[$ym];
            }
        }

        return self::formatCovidCases($result);
    }
}