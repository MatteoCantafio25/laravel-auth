// Recupero i fields
const imageField = document.getElementById('image');
const previewField = document.getElementById('preview');
const placeholder = 'https://marcolanci.it/boolean/assets/placeholder.png';


// Recupero bottone e input-group
const changeImageButton = document.getElementById('change-image-button');
const previousImageField = document.getElementById('previous-image-field');



//? PREVIEW

let blobUrl = '';

imageField.addEventListener('input', () => {
    // Controllo se ho il file
    if(imageField.files && imageField.files[0]){
        // Lo inserisco in una costante
        const file = imageField.files[0];

        // Creo un url temporaneo
        blobUrl = URL.createObjectURL(file);

        // Lo inserisco come src della preview
        previewField.src = blobUrl;
    }else{
        // Se non c'è il file metti il placeholder 
        previewField.src = placeholder;
    }
});

window.addEventListener('beforeunload', () => {
    if(blobUrl) URL.revokeObjectURL(blobUrl);
})

//? GESTIONE CAMPO FILE

// Al click del bottone cambio input mostrato
changeImageButton.addEventListener('click', () => {
    //Aggiungo la classe d-none a previousImageField
    previousImageField.classList.add('d-none');

    //Rimuovo la classe d-none a previousImageField
    imageField.classList.remove('d-none');

    // Rimetto il placeholder
    previewField.src = placeholder;

    //Richiamo il click sul field per non dover premere "Choose File" dopo
    imageField.click();
})