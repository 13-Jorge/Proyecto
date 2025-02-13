function redirectToHome(user) {
    localStorage.setItem('username', user);
    window.location.href = '../index.php';
}
