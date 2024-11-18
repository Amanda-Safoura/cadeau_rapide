@extends('backoffice.layouts.main')

@section('title', 'Tableau de Bord')

@section('additionnal_css')
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <style>
        #editor-container {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            background-color: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h1>Modifier le modèle : {{ ucfirst($template->type) }}</h1>
                <form action="{{ route('dashboard.email_templates.update', $template->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content" class="h4 my-4 text-decoration-underline">Contenu du Mail</label> :
                        <div id="editor-container" style="height: 300px;">{!! $template->content !!}</div>
                        <input type="hidden" name="content" id="hidden-content">
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('additionnal_js')
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        let quill = new Quill('#editor-container', {
            theme: 'snow'
        });

        // Synchroniser le contenu dans le champ caché en temps réel
        quill.on('text-change', function() {
            document.querySelector('#hidden-content').value = quill.root.innerHTML;
        });

        // Synchronisation finale lors de la soumission
        document.querySelector('form').addEventListener('submit', function(e) {
            // Met à jour le champ caché
            document.querySelector('#hidden-content').value = quill.root.innerHTML;
        });
    </script>
@endsection
