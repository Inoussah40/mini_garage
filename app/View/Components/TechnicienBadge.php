<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TechnicienBadge extends Component
{
    public string $nom;
    public string $prenom;

    public function __construct(string $nom, string $prenom)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function render(): View|Closure|string
    {
        return view('components.technicien-badge');
    }
}
