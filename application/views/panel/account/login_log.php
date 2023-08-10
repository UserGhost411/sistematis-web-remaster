<div class="card mb-4">
    <div class="card-header"> Login Logs</a></div>
    <div class="card-body">
        <table class="table table-striped border" id="companylist">
            <thead>
                <tr>
                    <th>Login Status</th>
                    <th>IP Address</th>
                    <th>UserAgent</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>
</div>
<script>
    let tdatable;

    function getval(obj) {
        if (document.getElementById(obj) == null) return "";
        return document.getElementById(obj).value;
    }

    $(document).ready(() => {
        tdatable = $('#companylist').DataTable({
            "initComplete": function(settings, json) {
                appLoadTooltip();
            },
            ajax: {
                url: '<?= base_url("account/data/log") ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            order: [[3, 'desc']],
            columns: [{
                    data: 'login_status',
                    render: function(data, type, row) {
                        let status = ["Failed", "Success"];
                        let bss = ["danger", "success"];
                        return `<span class="badge bg-${bss[data]}-gradient">${status[data]}</span>`;
                    }
                },
                {
                    data: 'login_ip',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'login_ua',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'created_at',
                    render: DataTable.render.datetime('DD/MM/YYYY HH:mm:ss'),
                },
            ]
        });
    });
</script>