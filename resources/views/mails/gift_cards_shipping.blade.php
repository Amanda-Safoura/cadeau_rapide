@extends('mails.layouts.main')

@section('mail_content')
    <div class="content text-start">
        <div class="card">
            <div class="card-header">
                Bonjour {{ $name }},
            </div>
            <div class="card-body">
                {!! $mail_content !!}
            </div>
        </div>
    </div>
@endsection
