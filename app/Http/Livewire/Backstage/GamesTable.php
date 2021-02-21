<?php

namespace App\Http\Livewire\Backstage;

use App\Models\Campaign;
use App\Models\Game;

class GamesTable extends TableComponent
{
    public $sortField = 'revealed_at';

    public function render()
    {
        $columns = [
            [
                'title' => 'account',
                'sort' => true,
            ],

            [
                'title' => 'prizeId',
                'attribute' => 'prizeId',
                'sort' => true,
            ],


            [
                'title' => 'title',
                'attribute' => 'account',
                'sort' => true,
            ],

            [
                'title' => 'revealed at',
                'attribute' => 'revealed_at',
                'sort' => true,
            ],
        ];
        
        return view('livewire.backstage.table', [
            'columns' => $columns,
            'resource' => 'games',
            'rows' => Game::filter()
                ->take($this->perPage)
                ->orderBy($this->sortField, $this->sortAsc ? 'DESC' : 'ASC')
                ->select('account', 'prizeId', 'account', 'revealed_at')
                ->paginate($this->perPage),
        ]);
    }
}
