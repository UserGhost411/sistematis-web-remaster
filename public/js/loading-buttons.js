document.querySelectorAll('.btn-loading').forEach(element=>{const btn=new coreui.LoadingButton(element);element.addEventListener('click',event=>{const myBtn=coreui.LoadingButton.getInstance(event.target);myBtn.start();});});