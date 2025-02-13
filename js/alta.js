function alta() {
    const pass = document.getElementById('pass').value;
    const confirmPass = document.getElementById('confirmPass').value;
    if (pass !== confirmPass) {
        alert('Las contraseñas no coinciden');
        return;
    }
    const form = document.forms['form'];
    for (let i = 0; i < form.length; i++) {
        if (form[i].value === '' && form[i].hasAttribute('required')) {
            alert('ERROR: Campos vacíos');
            return;
        }
    }
    form.action = "../login/procesarRegistro.php"; 
    form.submit();
}
