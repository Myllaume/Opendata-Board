/**
 * Total des lignes et colonnes
 * ---
 * Pour chaque ligne et colonne on fait la somme des cellules et on l'affiche
 * dans les cellules de total.
 * On fait aussi une moyenne de chaque ligne et colonne pour donner
 * une couleur adaptée à la cellules de total.
 */

function showTotals() {
    
    var index = 0;
    var totalColsCells = $('.total-col');
    var nbRow = 0;
    
    $('.total-row').each(function( rowIndex ) { // pour chaque cellule de total...
        nbRow++;
        var totalCell = $( this );
    
        totalCell.parent().each(function( i ) { //... retrouver la ligne entière...
            var totalRow = 0;
            // var totalCol = 0;
    
            $( this ).children().each(function( colIndex ) { //... lui prendre chaque cellule...
                colIndex--;
                
                if ($( this ).hasClass('sum-cell')) { //... si elle porte la class 'sum-col'
                    //... additionner leur contenu :
                    var cellNumber = parseInt($( this ).text()); // contenu numérique cellule
                    totalRow += cellNumber;

                    if (totalColsCells[colIndex] !== undefined) {
                        // Calcul du total par colonnes :
                        // Pour chaque cellule on place sa valeur au bas de sa colonne...
                        var lastColTotal = parseInt(totalColsCells[colIndex].textContent);
                        //... en additionnant chaque changement de valeur
                        var newColTotal = lastColTotal + cellNumber;
                        totalColsCells[colIndex].textContent = newColTotal;
                    }
                    
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

    totalColsCells.each(function( i ) {
        // On reprend le total de chaque cellule de total de colonne...
        var totalCol = $(this);
        var moyenneParColonne = parseInt((totalCol.text()) / nbRow );

        //... on la colore en fonction de la moyenne
        totalCol.css('background-color', 'rgba( 255, 187, 51, ' + moyenneParColonne / 100 + ')');
        //... et on l'affiche dans un Popover
        totalCol.popover({
            title: 'Moyenne',
            content: moyenneParColonne.toFixed(2) + ' sur 100',
            trigger: 'hover',
            placement: 'top'
        });
    })

}