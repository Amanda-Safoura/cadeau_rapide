@extends('backoffice.layouts.main')

@section('title', 'Tableau de Bord')

@section('additionnal_css')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="h3 mb-3">Personnalisation des Emails</div>

            @if ($templates->isEmpty())
                <div class="alert alert-warning">
                    Aucun modèle d'email n'est configuré pour le moment.
                </div>
            @else
                <ul class="nav nav-tabs" id="emailTabs" role="tablist">
                    @foreach ($templates as $template)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($loop->first) active @endif"
                                id="tab-{{ join('-', explode(' ', $template->type)) }}" data-bs-toggle="tab"
                                data-bs-target="#content-{{ join('-', explode(' ', $template->type)) }}" type="button" role="tab"
                                aria-controls="content-{{ join('-', explode(' ', $template->type)) }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $template->type }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="emailTabContent">
                    @foreach ($templates as $template)
                        <div class="tab-pane fade @if ($loop->first) show active @endif"
                            id="content-{{ join('-', explode(' ', $template->type)) }}" role="tabpanel" aria-labelledby="tab-{{ join('-', explode(' ', $template->type)) }}">
                            <div class="mt-3">
                                <h3>{{ $template->type }}</h3>
                                <p>{!! $template->content !!}</p>
                                <a href="{{ route('dashboard.email_templates.edit', $template->id) }}"
                                    class="btn btn-primary btn-sm mt-2">Modifier</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

@section('additionnal_js')
@endsection
