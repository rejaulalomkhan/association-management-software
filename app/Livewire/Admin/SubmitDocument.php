<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use Illuminate\Support\Str;

class SubmitDocument extends Component
{
    use WithFileUploads;

    public $subject;
    public $description;
    public $document_file;

    public function submitDocument()
    {
        $this->validate([
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'document_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB
        ], [
            'subject.required' => 'বিষয় প্রয়োজন।',
            'subject.max' => 'বিষয় সর্বোচ্চ ২৫৫ অক্ষরের হতে পারবে।',
            'description.max' => 'বর্ণনা সর্বোচ্চ ১০০০ অক্ষরের হতে পারবে।',
            'document_file.required' => 'ডকুমেন্ট ফাইল নির্বাচন করুন।',
            'document_file.mimes' => 'শুধুমাত্র PDF, JPG, JPEG, PNG ফাইল আপলোড করা যাবে।',
            'document_file.max' => 'ফাইলের সাইজ সর্বোচ্চ ১০ এমবি হতে পারবে।',
        ]);

        // Generate unique filename
        $extension = $this->document_file->getClientOriginalExtension();
        $filename = Str::uuid() . '.' . $extension;
        
        // Store file in documents folder organized by year/month
        $year = date('Y');
        $month = date('m');
        $filePath = $this->document_file->storeAs(
            "documents/{$year}/{$month}",
            $filename,
            'public'
        );

        // Create document record
        Document::create([
            'subject' => $this->subject,
            'description' => $this->description,
            'file_path' => $filePath,
            'file_name' => $this->document_file->getClientOriginalName(),
            'file_type' => $extension,
            'file_size' => $this->document_file->getSize(),
            'uploaded_by' => auth()->id(),
        ]);

        session()->flash('success', 'ডকুমেন্ট সফলভাবে আপলোড হয়েছে।');

        // Reset form
        $this->reset(['subject', 'description', 'document_file']);

        // Redirect to documents list
        return redirect()->route('documents.list');
    }

    public function render()
    {
        return view('livewire.admin.submit-document')->layout('layouts.app');
    }
}
