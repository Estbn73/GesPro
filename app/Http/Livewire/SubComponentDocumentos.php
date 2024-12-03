<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;

class SubComponentDocumentos extends Component
{
    use WithFileUploads;

    public $proyectoId;
    public $documentos;
    public $nombreDocumento;
    public $archivo;
    public $mostrarFormulario = false;
    public $mensajeExito = '';

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
            'archivo' => 'required|file|max:10240', // Máximo 10MB
        ]);

        $path = $this->archivo->store('documentos', 'public');

        Document::create([
            'name' => $this->nombreDocumento,
            'file_path' => $path,
            'user_id' => auth()->id(),
            'proyecto_id' => $this->proyectoId, // Relacionar con el proyecto actual
        ]);

        $this->reset(['nombreDocumento', 'archivo', 'mostrarFormulario']);
        $this->mensajeExito = '¡Documento subido correctamente!';

        $this->cargarDocumentos();
    }

    public function descargarDocumento($id)
    {
        $document = Document::findOrFail($id);

        if (!\Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'El archivo no se encuentra en el servidor.');
        }

        $filePath = storage_path('app/public/' . $document->file_path);
        $fileName = $document->name . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION);

        return response()->download($filePath, $fileName);
    }

    public function eliminarDocumento($id)
    {
        $document = Document::findOrFail($id);

        if ($document->user_id !== auth()->id()) {
            session()->flash('error', 'No tienes permiso para eliminar este documento.');
            return;
        }

        if ($document->file_path && \Storage::disk('public')->exists($document->file_path)) {
            \Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        $this->cargarDocumentos();
        session()->flash('success', 'Documento eliminado correctamente.');
    }

    public function render()
    {
        return view('livewire.sub-component-documentos');
    }
}
