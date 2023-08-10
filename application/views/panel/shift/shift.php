<div class="card mb-4">
    <div class="card-header"> Shift Management</a></div>
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>
<script>
    $(document).ready(() => {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            //themeSystem: 'bootstrap',
            events: '<?= base_url("shift/data/list") ?>',
            // headerToolbar: {
            //     left: 'prev,next',
            //     center: 'title',
            //     right: 'dayGridMonth,timeGridWeek,timeGridDay' // user can switch between the two
            // }
        });
        calendar.render();
    });
</script>