<?php

namespace App\Services;

use App\Serie;

class CriadorDeSerie
{
    public function criarSerie(string $nome, int $qtdTemp, int $epPorTemp): Serie
    {
        $serie = Serie::create(['nome' => $nome]);

        for ($i = 1; $i <= $qtdTemp; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for ($j = 1; $j <= $epPorTemp; $j++) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }

        return $serie;
    }
}