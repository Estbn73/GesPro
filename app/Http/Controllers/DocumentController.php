<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
use Illuminate\Http\Request;


class DocumentController extends Controller
{
    public function store(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,txt|max:2048',
        ]);
    
        $filePath = $request->file('file')->store('documents');
    
        Document::create([
            'name' => $request->input('name'),
            'file_path' => $filePath,
            'proyecto_id' => $proyecto->id
        ]);
    
        return redirect()->route('proyectos.documents.index', $proyecto)->with('success', 'Documento subido correctamente.');
    }
    
    public function download($id)
    {
        $document = Document::findOrFail($id);
        return Storage::download($document->file_path);
    }

    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

        // Método para eliminar un documento
    public function destroy(Document $document)
    {
        // Eliminar el archivo del almacenamiento
        if (\Storage::disk('public')->exists($document->file_path)) {
            \Storage::disk('public')->delete($document->file_path);
        }

        // Eliminar el registro del documento de la base de datos
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Documento eliminado correctamente.');
    }
}

