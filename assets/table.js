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
        totalCell.text(totalRow); // mettre le total dans la cellule de total.
        totalCell.css('background-color', 'rgba(51, 212, 255, ' + (totalRow / index) / 100 + ')');
        totalCell.popover({
            title: 'Moyenne',
            content: totalRow / index,
            trigger: 'hover',
            placement: 'left'
        });
        index = 0;
    })
})