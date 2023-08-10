var curentTheme = getCookie("display_theme"),
    dark = document.querySelector("#darkTheme"),
    light = document.querySelector("#lightTheme"),
    switcher = document.querySelector("#modeSwitcher");
switcher.addEventListener("click", modeSwitch);
function modeSwitch() {
    var o = getCookie("display_theme");
    console.log("swicth from", o);
    //o ? "dark" == o ? (dark.disabled = !0, light.disabled = !1, setCookie("display_theme", "light", 365)) : (dark.disabled = !1, light.disabled = !0, setCookie("display_theme", "dark", 365)) : $("body").hasClass("dark") ? (dark.disabled = !1, light.disabled = !0, setCookie("display_theme", "dark", 365)) : (dark.disabled = !0, light.disabled = !1, setCookie("display_theme", "light", 365))
    if(o=="light"){
        o = "dark"
    }else{
        o = "light"
    }
    if (o == "dark") {
        light.disabled = true;
        dark.disabled = false;
        switcher.innerHTML = `<i class="mdi mdi-power-sleep"></i>`
    } else {
        light.disabled = false;
        dark.disabled = true;
        switcher.innerHTML = `<i class="mdi mdi-weather-sunny"></i>`
    }
    setCookie("display_theme", o, 365);
}
if (curentTheme != null && curentTheme!="") {
    if (curentTheme == "light") {
        light.disabled = false;
        dark.disabled = true;
        switcher.innerHTML = `<i class="mdi mdi-power-sleep"></i>`
    } else {
        light.disabled = true;
        dark.disabled = false;
        switcher.innerHTML = `<i class="mdi mdi-weather-sunny"></i>`
    }
}else{
    setCookie("display_theme", "light", 365);
    light.disabled = false;
    dark.disabled = true;
    switcher.innerHTML = `<i class="mdi mdi-weather-sunny"></i>`
}
try {
    //console.log(curentTheme), curentTheme ? ("dark" == curentTheme ? (dark.disabled = !1, light.disabled = !0, colors = darkColor) : "light" == curentTheme && (dark.disabled = !0, light.disabled = !1), switcher.dataset.mode = curentTheme) : $("body").hasClass("dark") ? (colors = darkColor, setCookie("display_theme", "dark", 365)) : setCookie("display_theme", "light", 365);
} catch (err) {

}
