<div class="card mb-4">
    <div class="card-header"> Reports</a></div>
    <div class="card-body">
        <table class="table table-striped border" id="companylist">
            <thead>
                <tr>
                    <th>Report Name</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <iframe class="d-none" id="print_frame" onload="onMyFrameLoad(this)" style="width:1px;height:1px;"></iframe>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Device", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary btn-loading" onclick="save(this);">Save changes</button>']); ?>
<script>
    let tdatable;
    let btnaa = null;
    let startdate = `<?= date("Y-m-d", strtotime("-1 day")) ?>`
    let enddate = `<?= date("Y-m-d") ?>`

    function onMyFrameLoad() {
        if (btnaa != null) btnaa.innerHTML = `<i class="fad fa-print"></i> Print`;
        $('#generalModal').modal('hide')
    }

    function print(btn) {
        btnaa = btn
        if (btnaa != null) btnaa.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        document.getElementById("print_frame").src = `${$(btn).attr("href")}`;
    }

    function custom() {
        $("#gm_title").html("Print Custom Range");
        $.get("<?= base_url("report/custom") ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
            appLoadDatepicker("#myDatePickerstart");
            appLoadDatepicker("#myDatePickerend");
            const myDatePickerstart = document.getElementById('myDatePickerstart')
            myDatePickerstart.addEventListener('dateChange.coreui.date-picker', date => {
                dateajx = `${date.date.getFullYear()}-${((date.date.getMonth()+1).toString().padStart(2, '0'))}-${date.date.getDate().toString().padStart(2, '0')}`
                startdate = `${dateajx}`
            })
            const myDatePickerend = document.getElementById('myDatePickerend')
            myDatePickerend.addEventListener('dateChange.coreui.date-picker', date => {
                dateajx = `${date.date.getFullYear()}-${((date.date.getMonth()+1).toString().padStart(2, '0'))}-${date.date.getDate().toString().padStart(2, '0')}`
                enddate = `${dateajx}`
            })
        });
    }

    function save(btn) {
        document.getElementById("print_frame").src = `<?= base_url("report/prints/6") ?>?start=${startdate}&end=${enddate}`;
    }

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
                url: '<?= base_url("report/data/list") ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [{
                    data: 'report',
                    render: {
                        _: 'report_name',
                        sort: 'id'
                    }
                },
                {
                    data: 'report_start'
                },
                {
                    data: 'report_end',
                },
                {
                    data: 'report',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->c ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="${data.id==6?"custom":"print"}(this)" href="<?= base_url("report/prints/") ?>${data.id}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Print out Reports"><i class="fad fa-print"></i> Print</button>`;
                    }
                },
            ]
        });
    });
</script>