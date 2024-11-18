@extends('backoffice.layouts.main')

@section('title', 'Tableau de Bord')

@section('additionnal_css')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h1>Modifier le modèle : {{ ucfirst($template->type) }}</h1>
                <form action="{{ route('dashboard.email_templates.update', $template->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Contenu du Mail :</label>
                        <textarea name="content" id="content" class="form-control">{{ $template->content }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('additionnal_js')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste help',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
            height: 500
        });
    </script>
@endsection
