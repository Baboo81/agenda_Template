@extends('layouts.app')

@section('title', 'Agenda')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">
@endsection

@section('content')
{{-- Modal --}}
<section>
    <div class="modal fade" id="hoursModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-calendar-check me-2"></i>
                        Créneaux du <span id="selectedDate"></span>
                    </h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div id="hoursContainer" class="d-flex flex-wrap gap-2"></div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Modal END --}}

<div class="calendar-container p-5">

    {{-- Navigation --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button class="btn btn-light shadow-sm" id="prevMonth">◀</button>

        <h3 class="fw-bold mb-0" id="currentMonth"></h3>

        <button class="btn btn-light shadow-sm" id="nextMonth">▶</button>
    </div>

    {{-- Jours --}}
    <div class="calendar-weekdays">
        <div>Lun</div>
        <div>Mar</div>
        <div>Mer</div>
        <div>Jeu</div>
        <div>Ven</div>
        <div>Sam</div>
        <div>Dim</div>
    </div>

    {{-- Grille --}}
    <div class="calendar-grid" id="calendarGrid"></div>

</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/calendar.js') }}"></script>
    <script src="{{ asset('assets/js/agenda.js') }}"></script>
@endsection
