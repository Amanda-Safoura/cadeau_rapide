@extends('mails.layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            Bonjour {{ $name }},
        </div>
        <div class="card-body">
            {!! $mail_content !!}
        </div>
    </div>
@endsection
