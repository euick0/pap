const registerPopUp = document.getElementById('registerPopUp');

accountCreationModal.showModal();

if (registerPopUp && registerPopUp.textContent.trim() !== '') {
        registerPopUp.classList.add('show');
        setTimeout(() => registerPopUp.classList.remove('show'), 5000);
    }