<?php

namespace App\Livewire;

use Livewire\Component;
use App\Support\DocsCode;

class LoadCode extends Component
{
    public string|array $name;
    public bool $isSingle = true;
    public array $data = [];

    public function mount(string|array $name)
    {
        $this->name = $name;
        $this->isSingle = is_string($name);

        $docs = cache()->remember('docs_code_all_', now()->addHours(24), fn() => DocsCode::all());

        if ($this->isSingle) {
            $this->data = $docs[$name] ?? ['code' => '', 'lang' => 'text'];
        } else {
            $this->data = collect($name)
                ->filter(fn($n) => isset($docs[$n]))
                ->map(fn($n) => $docs[$n])
                ->values()
                ->toArray();
        }
    }

    public function render()
    {
        return view('livewire.load-code');
    }
}