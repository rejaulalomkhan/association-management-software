<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;

class DocumentList extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $documents = Document::with('uploader')
            ->when($this->search, function ($query) {
                $query->where('subject', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.document-list', [
            'documents' => $documents,
        ])->layout('layouts.app');
    }
}
