function appLoadTooltip() {
    const aa = document.querySelectorAll('.bs-tooltip-auto');
    for (const a of aa) {
        a.remove();
    }
    const tooltipTriggerList = document.querySelectorAll('[data-coreui-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new coreui.Tooltip(tooltipTriggerEl))
}
function appLoadTimerPicker() {
    const timePickerElementList = Array.prototype.slice.call(document.querySelectorAll('[data-coreui-toggle="time-picker"]'))
    const timePickerList = timePickerElementList.map(timePickerEl => {
        return new coreui.TimePicker(timePickerEl)
    })
}
function appLoadSelect2(selector = "") {
    $('.select2').select2({
        theme: 'bootstrap4',
        dropdownParent: $(`${selector} .modal-content`),

    });
}
function appLoadDatepicker(selector = ".date-picker") {
    const datePickerElementList = Array.prototype.slice.call(document.querySelectorAll(selector))
    const datePickerList = datePickerElementList.map(datePickerEl => {
        return new coreui.DatePicker(datePickerEl)
    })
}
function htmlspecialchars(str) {
    if(str==null || str==undefined || str=="") return "";
    const replacements = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return str.replace(/[&<>"']/g, match => replacements[match]);
}
function dthtmlspecialchars(data, type, row) {
    return htmlspecialchars(data);
}
appLoadDatepicker();
appLoadSelect2();
appLoadTimerPicker();
appLoadTooltip();
