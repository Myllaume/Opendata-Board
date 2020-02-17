/**
 * Total des lignes
 * ---
 * Pour chaque ligne on fait la somme des cellules et on l'affiche
 * sur la dernière cellule de la colonne "Total"
 */

$('.total-col').each(function( i ) { // pour chaque cellule de total...
    var totalCell = $( this );
    totalCell.parent().each(function( i ) { //... retrouver la ligne entière...
        var totalRow = 0
        $( this ).children().each(function( i ) { //... lui prendre chaque cellule...
            if ($( this ).hasClass('sum-col')) { //... si elle porte la class 'sum-col'
                totalRow += parseInt($( this ).text()) //... additionner leur contenu
            }
        })
        totalCell.text(totalRow) // mettre le total dans la cellule de total.
    })
})