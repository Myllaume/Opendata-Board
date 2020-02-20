/**
 * Total des lignes
 * ---
 * Pour chaque ligne on fait la somme des cellules et on l'affiche
 * sur la dernière cellule de la colonne "Total"
 * On fait aussi une moyenne de chaque ligne pour donner une couleur lors du total
 */

var index = 0;

$('.total-col').each(function( i ) { // pour chaque cellule de total...
    var totalCell = $( this );

    totalCell.parent().each(function( i ) { //... retrouver la ligne entière...
        var totalRow = 0;

        $( this ).children().each(function( i ) { //... lui prendre chaque cellule...
            if ($( this ).hasClass('sum-col')) { //... si elle porte la class 'sum-col'
                totalRow += parseInt($( this ).text()); //... additionner leur contenu
                index++;
            }
        })

        totalCell.text(totalRow); // afficher le total dans la cellule de total.
        var moyenneParLigne = totalRow / index; // cacluler une moyenne des totaux

        // donner une couleur à la cellule par rapport à sa moyenne
        totalCell.css('background-color', 'rgba(51, 212, 255, ' + moyenneParLigne / 100 + ')');
        // afficher un Popover pour indiquer le moyenne au survol des totaux par ligne
        totalCell.popover({
            title: 'Moyenne',
            content: moyenneParLigne.toFixed(2) + ' sur 100',
            trigger: 'hover',
            placement: 'left'
        });
        
        index = 0;
    })
})