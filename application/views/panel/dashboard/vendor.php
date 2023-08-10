<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary-gradient">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold"><?= $this->db->get_where("account", [])->num_rows() ?></div>
                    <div>Registered Users</div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info-gradient">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold"><?= $this->db->get_where("company", [])->num_rows() ?></div>
                    <div>Registered Company</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning-gradient">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold"><?= $this->db->get_where("stock", [])->num_rows() ?></div>
                    <div>Stock Rate</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger-gradient">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold"><?= $this->db->get_where("incident", [])->num_rows() ?></div>
                    <div>Incident Reported</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
<!-- /.row-->


<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header"> <a href="<?= base_url("incident") ?>">Incident</a></div>
            <div class="card-body">
                <table class="table table-sm table-striped border" id="incident_actives">
                    <thead>
                        <tr>
                            <th>Incident</th>
                            <th>Device</th>
                            <th>Status</th>
                            <th>Last Update</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(() => {
        const tbl_shift = $('#shift_actives').DataTable({
            ajax: {
                url: '<?= base_url("home/data/active_shift") ?>',
                dataSrc: 'data',
            },
            columns: [{
                    data: 'account_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'shift_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'company_name',
                    render: dthtmlspecialchars,
                },
            ]
        });

        const tbl_stock = $('#stock_needs').DataTable({
            ajax: {
                url: '<?= base_url("home/data/low_stock") ?>',
                dataSrc: 'data',
            },
            columns: [{
                    data: 'stock_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'stock_type_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'total_stock',
                    render: dthtmlspecialchars,
                },
            ]
        });
        const tbl_incident = $('#incident_actives').DataTable({
            ajax: {
                url: '<?= base_url("home/data/incidents") ?>',
                dataSrc: 'data',
            },
            columns: [{
                    data: 'incident_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'device_name',
                    render: function(data, type, row) {
                        return (row.incident_device == 0 ? `Non-Device` : data);
                    }
                },
                {
                    data: 'incident_status',
                    render: function(data, type, row) {
                        const a = ["On Progress", "Done", "Hold"];
                        const b = ["info", "success", "warning"]
                        return `<span class="badge bg-${b[data]}-gradient">${a[data]}</span>`;
                    }
                },
                {
                    data: 'updated_at',
                    render: DataTable.render.datetime('DD/MM/YYYY HH:mm:ss'),
                },
            ]
        });
        setInterval(function() {
            tbl_incident.ajax.reload(null, false);
            tbl_stock.ajax.reload(null, false);
            tbl_shift.ajax.reload(null, false);
        }, 60000);
    });
</script>