@extends('Admin.layouts.template')

@section('content')
    <div class="card bg-light shadow-sm">
        <div class="card-header">
            <h3 class="card-title text-uppercase">Selamat Datang di Aplikasi Manajemen SDM</h3>
        </div>
        <div class="card-body p-4">
            <!-- Kalender Kegiatan Dosen -->
            <div id="calendar" class="mt-4"></div>

            <!-- FullCalendar CSS & JS -->
            <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        events: [
                            {
                                title: 'Rapat Koordinasi',
                                start: '2024-10-01'
                            },
                            {
                                title: 'Presentasi Proyek',
                                start: '2024-10-05'
                            },
                            {
                                title: 'Konsultasi Mahasiswa',
                                start: '2024-10-09'
                            },
                            {
                                title: 'Workshop Pendidikan',
                                start: '2024-10-15',
                                end: '2024-10-17'
                            },
                            {
                                title: 'Hotways',
                                start: '2024-10-18',
                                end: '2024-10-19'
                            }
                        ]
                    });
                    calendar.render();
                });
            </script>
        </div>
    </div>
@endsection
