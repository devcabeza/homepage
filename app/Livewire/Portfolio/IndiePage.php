<?php

declare(strict_types=1);

namespace App\Livewire\Portfolio;

use App\Application\Portfolio\Queries\GetIndiePageDataQuery;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.portfolio')]
#[Title('Proyectos Propios & MRR — Alejandro Cabeza')]
final class IndiePage extends Component
{
    public function render(GetIndiePageDataQuery $query): View
    {
        $data = $query->execute();

        return view('livewire.portfolio.indie-page', [
            'data' => $data,
        ]);
    }
}
