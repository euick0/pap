const loginPopUp = document.getElementById('loginPopUp');

loginModal.showModal();

if (loginPopUp && loginPopUp.textContent.trim() !== '') {
        loginPopUp.classList.add('show');
        setTimeout(() => loginPopUp.classList.remove('show'), 5000);
}