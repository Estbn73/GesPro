<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentosComponent extends Component
{
    use WithFileUploads;

    public $proyectoId;
    public $documentos;
    public $nombreDocumento;
    public $archivo;

    public function mount($proyectoId)
    {
        $this->proyectoId = $proyectoId;
        $this->cargarDocumentos();
    }

    public function cargarDocumentos()
    {
        $this->documentos = Document::where('proyecto_id', $this->proyectoId)->get();
    }

    public function subirDocumento()
    {
        $this->validate([
            'nombreDocumento' => 'required|string|max:255',
            'archivo' => 'required|file|mimes:pdf,doc,docx,txt|max:2048',
        ]);

        $filePath = $this->archivo->store('documents');

        Document::create([
            'name' => $this->name,
            'file_path' => $path,
            'proyecto_id' => $this->proyecto->id,
            'user_id' => auth()->id(),
        ]);
        

        $this->reset(['nombreDocumento', 'archivo']);
        $this->cargarDocumentos();
        session()->flash('success', 'Documento subido correctamente.');
    }

    public function descargarDocumento($id)
    {
        $documento = Document::findOrFail($id);

        return response()->download(Storage::path($documento->file_path));
    }

    public function eliminarDocumento($id)
    {
        $documento = Document::findOrFail($id);

        if (Storage::exists($documento->file_path)) {
            Storage::delete($documento->file_path);
        }

        $documento->delete();
        $this->cargarDocumentos();
        session()->flash('success', 'Documento eliminado correctamente.');
    }

    public function render()
    {
        return view('livewire.documentos-component');
    }
}
