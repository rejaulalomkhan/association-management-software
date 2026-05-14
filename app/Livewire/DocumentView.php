<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Document;

class DocumentView extends Component
{
    public $documentId;
    public $document;

    public function mount($id)
    {
        $this->documentId = $id;
        $this->document = Document::with('uploader')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.document-view')->layout('layouts.app');
    }
}
