
let themeStateLight = true;
function changeTheme() {
    themeStateLight = !themeStateLight;
    handleThemeChange(themeStateLight ? "light" : "dark")
}
function changeThemeSelect(a) {
    themeStateLight = !a.checked;
    handleThemeChange(a.checked ? "dark" : "light")
}

function handleThemeChange(theme = "light") {
    var event = document.createEvent('Event');
    event.initEvent('themeChange', true, true);
    if (theme === 'light') {
        themeStateLight = true;
        document.body.classList.remove('dark-theme');
        document.getElementById("darkmode-switch").checked = false;
        document.querySelector(`link[title="lightswal"]`).removeAttribute("disabled");
        document.querySelector(`link[title="darkswal"]`).setAttribute("disabled", "disabled");
        document.querySelector(`link[aa="lightselect"]`).removeAttribute("disabled");
        document.querySelector(`link[aa="darkselect"]`).setAttribute("disabled", "disabled");
        document.querySelector(`.navbar-brand-light`).classList.remove("d-none")
        document.querySelector(`.navbar-brand-dark`).classList.add("d-none")
    }
    if (theme === 'dark') {
        themeStateLight = false;
        document.body.classList.add('dark-theme');
        document.querySelector(`link[aa="darkselect"]`).removeAttribute("disabled");
        document.querySelector(`link[aa="lightselect"]`).setAttribute("disabled", "disabled");
        document.querySelector(`link[title="darkswal"]`).removeAttribute("disabled");
        document.querySelector(`link[title="lightswal"]`).setAttribute("disabled", "disabled");
        document.querySelector(`.navbar-brand-light`).classList.add("d-none")
        document.querySelector(`.navbar-brand-dark`).classList.remove("d-none")

        document.getElementById("darkmode-switch").checked = true;
    }
    document.getElementById('btn-theme-changer').innerHTML = themeStateLight ? `<i class="far fa-moon"></i>` : `<i class="fas fa-sun"></i>`
    setCookie("display_theme", theme, 365);
    document.body.dispatchEvent(event);
}
function handleAppSetting(namespace = "display_app_render", val = 1) {
    let names = {
        "display_app_memory":{
            "switch":"dismem-switch",
            "div":"#display-debug-memory"
        },
        "display_app_render":{
            "switch":"disrend-switch",
            "div":"#display-debug-render"
        },
    };
    if (val == 1) {
        document.querySelector(names[namespace].div).classList.remove("d-none")
        document.getElementById(names[namespace].switch).checked = true;
    } else {
        document.querySelector(names[namespace].div).classList.add("d-none")
        document.getElementById(names[namespace].switch).checked = false;
    }
    setCookie(namespace, val, 365);
}
let cr_theme = getCookie("display_theme");
let debug_mem = getCookie("display_app_memory");
let debug_rend = getCookie("display_app_render");
if (cr_theme != undefined && cr_theme != "") {
    handleThemeChange(cr_theme)
} else {
    handleThemeChange("light")
}
if (debug_mem != undefined && debug_mem != "") {
    handleAppSetting("display_app_memory",debug_mem)
} else {
    handleAppSetting("display_app_memory",0)
}
if (debug_rend != undefined && debug_rend != "") {
    handleAppSetting("display_app_render",debug_rend)
} else {
    handleAppSetting("display_app_render",0)
}