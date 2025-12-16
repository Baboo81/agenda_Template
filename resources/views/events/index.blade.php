@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Mes Événements</h1>
        <a href="{{ route('events.create') }}" class="btn btn-success">Créer un événement</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($events->isEmpty())
        <p class="text-muted">Aucun événement pour le moment.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->description ?? '-' }}</td>
                        <td>{{ $event->start_time }}</td>
                        <td>{{ $event->end_time ?? '-' }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary btn-sm">Éditer</a>

                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet événement ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
