<div class="card mb-4">
    <div class="card-header"> Access Management</a></div>
    <div class="card-body">
        <table class="table table-striped border" id="privilist">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Privilege</th>
                    <th>Access on Privilege</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php $this->load->view('include/modal', ["size" => "md", "title" => "Access", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" onclick="save(this);">Save changes</button>']); ?>
<script>
    let tdatable;

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
                $.post("<?= base_url("access/data/delete") ?>", {
                    "access_id": id,
                }, function(data) {
                    Swal.fire(
                        'Removed!',
                        'User has been deleted from System.',
                        'success'
                    )
                    tdatable.ajax.reload();
                });
            }
        })
    }

    function getval(obj) {
        if (document.getElementById(obj) == null) return "";
        return document.getElementById(obj).value;
    }

    $(document).ready(() => {
        let abno = 1;
        tdatable = $('#privilist').DataTable({
            ajax: {
                url: '<?= base_url("access/data/list") ?>',
                dataSrc: 'data',
            },
            "fnDrawCallback": function() {
                appLoadTooltip();
            },
            columns: [
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return abno++;
                    }
                },
                {
                    data: 'privilege_name',
                    render: dthtmlspecialchars,
                },
                {
                    data: 'access_count'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `<a class="btn text-white btn-sm btn-success me-2" href="<?= base_url("access/show/") ?>${data}" data-coreui-toggle="tooltip" data-coreui-placement="bottom" title="Show"><i class="fas fa-chevron-right"></i></a>`;
                    }
                },
            ]
        });
    });
</script>