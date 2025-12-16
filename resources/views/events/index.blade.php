@extends('layouts.app')

@section('title', 'Agenda')

@section('content')
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

    <style>
        h3 {
            color: #5f526c
        }

        .calendar-container {
            max-width: 900px;
            margin: auto;
            border-radius: 22px;
            background-color: #99b7ef;
        }

        .calendar-weekdays,
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }

        .calendar-weekdays div {
            text-align: center;
            font-weight: 600;
            padding-bottom: 10px;
            color: #dde5ed;
        }

        .calendar-day {
            border: 1px solid #eee;
            height: 120px;
            padding: 8px;
            position: relative;
            background: white;
            transition: background .2s;
        }

        .calendar-day:hover {
            background: #f8f9fa;
            cursor: pointer;
        }

        .calendar-day-number {
            font-weight: 600;
        }

        .today {
            border: 2px solid #0d6efd;
            border-radius: 6px;
        }

        .event-dot {
            width: 8px;
            height: 8px;
            background: #dc3545;
            border-radius: 50%;
            position: absolute;
            bottom: 8px;
            left: 8px;
        }
    </style>

    <script>
        let currentDate = new Date();

        const monthNames = [
            "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
            "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
        ];

        function renderCalendar() {
            const grid = document.getElementById('calendarGrid');
            grid.innerHTML = '';

            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            document.getElementById('currentMonth').innerText =
                monthNames[month] + ' ' + year;

            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);

            let startDay = firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1;

            // Cases vides
            for (let i = 0; i < startDay; i++) {
                grid.innerHTML += `<div></div>`;
            }

            for (let day = 1; day <= lastDay.getDate(); day++) {
                const today = new Date();
                const isToday =
                    day === today.getDate() &&
                    month === today.getMonth() &&
                    year === today.getFullYear();

                grid.innerHTML += `
            <div class="calendar-day ${isToday ? 'today' : ''}">
                <div class="calendar-day-number">${day}</div>

                ${[5, 12, 18, 25].includes(day)
                    ? '<div class="event-dot"></div>'
                    : ''}
            </div>
        `;
            }
        }

        document.getElementById('prevMonth').onclick = () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        };

        document.getElementById('nextMonth').onclick = () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        };

        renderCalendar();
    </script>
@endsection
