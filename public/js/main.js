// =================== J'AFICHE LE MON DU FICHIER SUR LE FILE INPUT ===================

$('#photo').on('change',function(){
    //get the file name
    var fileName = $(this).val().split ("\\");
    //replace the "Choose a file" label
    $('.custom-file-label').html(fileName [2]);
    // $(this).next('.custom-file-label').html(fileName [2]);
})
