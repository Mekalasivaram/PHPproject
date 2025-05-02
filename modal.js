// modal.js
document.addEventListener('DOMContentLoaded', () => {
    const loginBtn = document.querySelector('a[href="login.html"]');
    const modal = document.getElementById('login-modal');
    const closeBtn = document.getElementById('close-modal');

    if (loginBtn && modal && closeBtn) {
        loginBtn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        closeBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });

        window.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    }
});
