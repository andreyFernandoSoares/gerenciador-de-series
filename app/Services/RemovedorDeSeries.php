<?php

namespace App\Services;

use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorDeSeries
{
    
    public function removerSerie(int $id): string
    {
        $nome = '';
        DB::transaction(function () use ($id, &$nome) {
            $serie = Serie::find($id);
            $nome = $serie->nome;
            $nome = $this->removeTemp($serie);
            $serie->delete();
        });
        
        return $nome;
    }

    private function removeTemp(Serie $serie): void
    {
        $serie->temporadas()->each(function (Temporada $temp){
            $this->removeEp($temp);
            $temp->delete();
        });
    }

    private function removeEp(Temporada $temp): void
    {
        $temp->episodios()->each(function (Episodio $ep){
            $ep->delete();
        });
    }
}