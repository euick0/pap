const accountCreationModal = document.querySelector('#accountCreationModal');
const openAccountCreationModalButton = document.querySelectorAll('.openAccountCreationModalButton');
const closeAccountCreationModalButton = document.querySelectorAll('.closeAccountCreationModalButton');

openAccountCreationModalButton.forEach(button => {
    button.addEventListener('click', () => {
        accountCreationModal.showModal();
    });
});

closeAccountCreationModalButton.forEach(button => {
    button.addEventListener('click', () => {
        accountCreationModal.close();
    })});