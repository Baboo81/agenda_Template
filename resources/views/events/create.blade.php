@extends('layouts.app')

@section('title', 'Créer un événement')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Créer un nouvel événement</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Date et heure de début</label>
                <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}" required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Date et heure de fin (facultatif)</label>
                <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') }}">
            </div>

            <button type="submit" class="btn btn-success">Ajouter l'événement</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
@endsection
