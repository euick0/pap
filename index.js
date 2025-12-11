const accountCreationModal = document.querySelector('#accountCreationModal');
const openAccountCreationModalButton = document.querySelectorAll('.openAccountCreationModalButton');
const closeAccountCreationModalButton = document.querySelectorAll('.closeAccountCreationModalButton');
const loginModal = document.querySelector("#loginModal")
const openLoginModalButton = document.querySelectorAll('.openLoginModalButton');
const closeLoginModalButton = document.querySelectorAll('.closeLoginModalButton');
const createAccountInsideLoginModalButton = document.querySelector('#createAccountButtonInsideLoginModal')
const logInButtonInsideAccountCreationModal = document.querySelector('#logInButtonInsideAccountCreationModal')

openAccountCreationModalButton.forEach(button => {
    button.addEventListener('click', () => {
        accountCreationModal.showModal();
    });
});

closeAccountCreationModalButton.forEach(button => {
    button.addEventListener('click', () => {
        accountCreationModal.close();
})});

//ao clicar fora do modal do criar conta fecha-lo
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

openLoginModalButton.forEach(button => {
    button.addEventListener('click', () => {
        loginModal.showModal();
    });
});

closeLoginModalButton.forEach(button => {
    button.addEventListener('click', () => {
        loginModal.close();
})});

//ao clicar fora do modal do criar conta fecha-lo
loginModal.addEventListener('click', (cursorPosition) => {
    const dialogDimensions = loginModal.getBoundingClientRect();
    if (
        cursorPosition.clientX < dialogDimensions.left ||
        cursorPosition.clientX > dialogDimensions.right ||
        cursorPosition.clientY < dialogDimensions.top ||
        cursorPosition.clientY > dialogDimensions.bottom) 
        {
            loginModal.close();
        }
})

logInButtonInsideAccountCreationModal.addEventListener('click', () =>{
    accountCreationModal.close();
    loginModal.showModal();
})

createAccountInsideLoginModalButton.addEventListener('click', () =>{
    loginModal.close();
    accountCreationModal.showModal();
})

