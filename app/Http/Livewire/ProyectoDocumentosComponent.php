<?php

namespace App\Http\Livewire;

use App\Models\Document;
use App\Models\Proyecto;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProyectoDocumentosComponent extends Component
{
    use WithFileUploads;

    public $proyecto;
    public $documentos;
    public $showModal = false;
    public $documento;
    public $name = '';
    public $file;
    public $document_id = null;

    public function mount($id)
    {
        $this->proyecto = Proyecto::findOrFail($id);
        $this->documentos = $this->proyecto->documents->map(function ($document) {
            $document->extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
            return $document;
        });
    }

    public function render()
    {
        return view('livewire.proyecto-documentos-component');
    }

    public function guardar()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xlsx,csv|max:10240', // Máximo: 10MB
        ]);

        if ($this->document_id) {
            $document = Document::find($this->document_id);
        } else {
            $document = new Document();
            $document->proyecto_id = $this->proyecto->id;
            $document->user_id = auth()->id(); // Asignar el usuario autenticado
        }

        $document->name = $this->name;

        // Guardar archivo y almacenar la ruta
        if ($this->file) {
            $path = $this->file->store('documents', 'public');
            $document->file_path = $path;
        }

        $document->save();

        $this->limpiarCampos();
        $this->showModal = false;
        $this->documentos = $this->proyecto->documents; // Actualizar lista de documentos
    }

    public function limpiarCampos()
    {
        $this->reset('name', 'file', 'document_id');
    }

    public function setItem($id)
    {
        $document = Document::find($id);
        $this->name = $document->name;
        $this->document_id = $id;
        $this->showModal = true;
    }

    public function eliminarDocumento($id)
    {
        $document = Document::findOrFail($id);

        // Eliminar archivo físico
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        $this->documentos = $this->proyecto->documents; // Actualizar lista
        session()->flash('success', 'Documento eliminado exitosamente.');
    }

    public function descargarDocumento($id)
    {
        $document = Document::findOrFail($id);

        // Verificar si el archivo existe en el disco
        if (Storage::disk('public')->exists($document->file_path)) {
            // Construir la ruta física del archivo manualmente
            $filePath = storage_path('app/public/' . $document->file_path);
            $fileName = $document->name; // Nombre amigable desde la base de datos

            return response()->download($filePath, $fileName, [
                'Content-Type' => mime_content_type($filePath),
            ]);
        }

        // Mensaje de error si el archivo no existe
        session()->flash('error', 'El archivo no se encuentra en el servidor.');
        return back();
    }
}
