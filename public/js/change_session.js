function change_session(btn) {
    const btn_real = btn.innerHTML;
    btn.innerHTML = `<i class="fas fa-spinner-third fa-spin"></i>`;
    $.post($(btn).attr("href"), {
        "target": gval("target_account_session"),
    }, function (data) {
        console.log(data.status)
        if (data.status == 200) window.location = $(btn).attr("base_url")
        $('#ChgSessionModal').modal('hide')
        $("#csm_body").html("");
        btn.innerHTML = btn_real;
    });
}
function loadcompses(sel) {
    $.post($(sel).attr("d-url"), {
        "company_id": sel.value,
    }, function (data) {
        if (data.status == 200) {
            $('#target_account_session').empty();
            $('#target_account_session').select2('data', null)
            $("#target_account_session").select2({
                data: data.data,
                theme: 'bootstrap4',
                dropdownParent: $(`#ChgSessionModal .modal-content`),
            })
        }
    });
}
function show_session_switch(btn) {
    $("#csm_title").html("Switch Session");
    $.get($(btn).attr("href"), function (data) {
        $('#ChgSessionModal').modal('toggle')
        $("#csm_body").html(data);
        appLoadSelect2("#ChgSessionModal");
    });
    return false;
}
function gval(obj) {
    if (document.getElementById(obj) == null) return "";
    if (document.getElementById(obj).value == null) return document.getElementById(obj);
    return document.getElementById(obj).value;
}