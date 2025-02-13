function login() {
    const form = document.forms['form'];
    for (let i = 0; i < form.length; i++) {
        if (form[i].value === '' && form[i].hasAttribute('required')) {
            alert('ERROR: Campos vacíos');
            return;
        }
    }
    form.action = "../login/procesarLogin.php";
    form.submit();
}
