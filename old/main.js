const contents = document.querySelectorAll(".content");
const adminContainer = document.querySelector('#adminIconContainer');
const adminContent = document.querySelector('#adminContent');
const accountOptionsContainer = document.getElementById('accountOptionsIconContainer');
const accountOptionsContent = document.getElementById('accountOptionsContent');
const logoContainer = document.querySelector('#logoIconContainer');
const mainContent = document.querySelector("#mainContent")
const adminPopUp = document.getElementById('adminPopUp');
const contentEditorPopUp = document.getElementById('contentEditorPopUp');
const contentEditorContent = document.getElementById('contentEditorContent');
const contentEditorContainer = document.getElementById('contentEditorContainer');

let summernoteInitialized = false;

document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page');

    if (page) {
        disableAllContents();
        switch (page) {
            case 'editor':
                if(contentEditorContent) contentEditorContent.classList.remove("inactive");
                ensureSummernoteInitialized();
                break;
            case 'admin':
                if(adminContent) adminContent.classList.remove("inactive");
                break;
            case 'account':
                if(accountOptionsContent) accountOptionsContent.classList.remove("inactive");
                break;
            case 'main':
            default:
                if(mainContent) mainContent.classList.remove("inactive");
                break;
        }
    }
});

function ensureSummernoteInitialized() {
    const el = document.getElementById('summernote');
    if (!el || summernoteInitialized) return;

    if (!window.jQuery) {
        console.error('jQuery not loaded. Summernote requires jQuery.');
        return;
    }
    if (!jQuery.fn || !jQuery.fn.summernote) {
        console.error('Summernote not loaded. Check the <script> include order in main.php.');
        return;
    }

    jQuery('#summernote').summernote({
        width:  1300,
        height: 700,
        tabsize: 1,

        // Show font dropdown + include your font
        fontNames: ['Interphases', 'Arial', 'Verdana', 'Times New Roman', 'Courier New'],
        fontNamesIgnoreCheck: ['Interphases'],

        toolbar: [
            ['style', ['style']],
            ['font', ['fontname', 'fontsize', 'bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });


    summernoteInitialized = true;
}

if (adminContainer && adminContent) {
    adminContainer.addEventListener('click', () => {
        disableAllContents();
        adminContent.classList.remove("inactive");
    });
}
logoContainer.addEventListener('click',() =>{
    disableAllContents();
    mainContent.classList.remove("inactive")
});

accountOptionsContainer.addEventListener('click',() =>{
    disableAllContents();
    accountOptionsContent.classList.remove("inactive")
});

contentEditorContainer.addEventListener('click',() =>{
    disableAllContents();
    contentEditorContent.classList.remove("inactive")
    // Initialize only when the tab is opened (avoids hidden-init layout issues)
        ensureSummernoteInitialized();

        // If already initialized, refresh after becoming visible
        if (summernoteInitialized) {
            setTimeout(() => jQuery('#summernote').summernote('refresh'), 0);
        }
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

if (contentEditorPopUp && contentEditorPopUp.textContent.trim() !== '') {
    disableAllContents();
    contentEditorContent.classList.remove("inactive")
    contentEditorPopUp.classList.add('show');
    setTimeout(() => contentEditorPopUp.classList.remove('show'), 5000);
}
