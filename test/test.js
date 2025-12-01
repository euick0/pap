let word1 = document.getElementById('word1');
let translationContainer = document.getElementById('translation-container');

word1.addEventListener('mouseover', enableTranslationContainer); 
word1.addEventListener('mouseout', disableTranslationContainer);

function enableTranslationContainer() {
    translationContainer.style.display = 'inline-block';
    console.log('hovered');
}


function disableTranslationContainer() {
    translationContainer.style.display = 'none';
}

    