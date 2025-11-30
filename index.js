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

//ao clicar fora do modal fecha-lo
accountCreationModal.addEventListener('click', (cursorPosition) => {
    const dialogDimensions = accountCreationModal.getBoundingClientRect();
    if (
        cursorPosition.clientX < dialogDimensions.left ||
        cursorPosition.clientX > dialogDimensions.right ||
        cursorPosition.clientY < dialogDimensions.top ||
        cursorPosition.clientY > dialogDimensions.bottom) 
        {
            accountCreationModal.close();
        }
})