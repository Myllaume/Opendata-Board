/***
 * Anti-spam
 * ---------
 * Génére une chaîne de caractère dans le champ 'bot_nempty' pour empêcher les bots
 * n'executant pas le JS d'envoyer un courriel.
 */

document.querySelector('[name="bot_nempty"]').value = '9hHZ@Jz623';

/***
 * Envoie formaire de contact
 * ---------
 * Envoie AJAX des données du formaire de contact à 'mail.php'
 * Reset du formulaire s'il y a envoie
 */

var formContact = $('#form-contact');
var formFeedback = $('#form-contact-feedback');

formContact.submit(function(event) {
    event.preventDefault();

    $.ajax({
        url: "./include/mail.php",
        type: 'POST',
        data: formContact.serialize(),
        dataType: 'JSON',
        success: function (JSON, statut) {
        
            if (JSON.isOk) {
                formContact.trigger('reset');
                formFeedback.addClass('alert-success');
            } else {
                formFeedback.addClass('alert-danger');
            }
            formFeedback.append(JSON.consolMsg);
        },
        error: function (resultat, statut, erreur) {
            console.log(resultat);
            console.error(erreur);
        }
    });

});