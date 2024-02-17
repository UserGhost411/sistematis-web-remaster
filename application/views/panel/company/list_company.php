<div class="card mb-4">
    <div class="card-header"> Company Management</a></div>
    <div class="card-body table-responsive">
        <table class="table table-striped border" id="companylist">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Location</th>
                    <th>Company Related User</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Company", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<script>
    let tdatable;

    function edit(btn) {
        $("#gm_title").html("Edit Company");
        $.get($(btn).attr("href"), function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
        });
    }

    function create() {
        $("#gm_title").html("Create Company");
        $.get("<?= base_url("companys/create") ?>", function(data) {
            $('#generalModal').modal('toggle')
            $("#gm_body").html(data);
        });
    }

    function save(btn) {
        const btn_real = btn.innerHTML;
        btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
        if (getval("company_id") == "") {
            $.post("<?= base_url("companys/data/add") ?>", {
                "company_name": getval("company_name"),
                "company_location": getval("company_location"),
                "company_info": getval("company_info"),
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);
            });
        } else {
            $.post("<?= base_url("companys/data/edit") ?>", {
                "company_id": getval("company_id"),
                "company_name": getval("company_name"),
                "company_location": getval("company_location"),
                "company_info": getval("company_info"),
            }, function(data) {
                $('#generalModal').modal('hide')
                $("#gm_body").html("");
                btn.innerHTML = btn_real;
                tdatable.ajax.reload(null, false);

            });
        }


    }

    function remove(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?= base_url("companys/data/delete") ?>", {
                    "company_id": id,
                }, function(data) {
                    Swal.fire(
                        'Removed!',
                        'Company has been deleted from System.',
                        'success'
                    )
                    tdatable.ajax.reload(null, false);
                });
            }
        })
    }

    function getval(obj) {
        if (document.getElementById(obj) == null) return "";
        return document.getElementById(obj).value;
    }

    $(document).ready(() => {
        tdatable = $('#companylist').DataTable({
            "initComplete": function(settings, json) {
                $("div.dataTables_filter").append('<button  <?= ($permission->c ? "" : "disabled") ?> type="button" class="btn btn-sm ms-1 btn-primary" style="vertical-align: baseline;" onclick="create();" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Create new Entry"><i class="fas fa-plus"></i></button>');
                appLoadTooltip();
            },
            ajax: {
                url: '<?= base_url("companys/data/list") ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [{
                    data: 'company_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'company_location',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'account_count'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-success me-2" onclick="edit(this)" href="<?= base_url("companys/edit/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button <?= ($permission->u ? "" : "disabled") ?> class="btn text-white btn-sm btn-info me-2" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Change Logo"><i class="far fa-image"></i></button>
                            <button <?= ($permission->d ? "" : "disabled") ?> ${row.account_count>0?"disabled":""} ${row.id==1?"disabled":""} class="btn text-white btn-sm btn-danger" onclick="remove(${data})" href="#" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Delete"><i class="far fa-trash-alt"></i></button>`;
                    }
                },
            ]
        });
    });
</script>