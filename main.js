const contents = document.querySelectorAll(".content");
const adminContainer = document.querySelector('#adminIconContainer');
const adminContent = document.querySelector('#adminContent');
const logoContainer = document.querySelector('#logoIconContainer');
const mainContent = document.querySelector("#mainContent")
const adminPopUp = document.getElementById('adminPopUp');

adminContainer.addEventListener('click',() =>{
    disableAllContents();
    adminContent.classList.remove("inactive")
});

logoContainer.addEventListener('click',() =>{
    disableAllContents();
    mainContent.classList.remove("inactive")
});

function disableAllContents(){
    contents.forEach(content => {
        if (!content.classList.contains("inactive")) {
            content.classList.add("inactive")
        }
    });
}

if (adminPopUp && adminPopUp.textContent.trim() !== '') {
    disableAllContents();
    adminContent.classList.remove("inactive")
    adminPopUp.classList.add('show');
    setTimeout(() => adminPopUp.classList.remove('show'), 5000);
}

