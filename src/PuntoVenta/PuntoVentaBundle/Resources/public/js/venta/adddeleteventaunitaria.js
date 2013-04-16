  $(function() {
        
        $('#ventasUnitarias').data('index', $('#ventasUnitarias').find('tr').length);

        $('#nuevaVentaUnitaria').on('click', function(e) {
            e.preventDefault();
            addTagForm($('#ventasUnitarias'));
        });

        $('#ventasUnitarias').find('.ventaUnitaria').each(function() {
            addTagFormDeleteLink($(this));
        });
    });

    function addTagFormDeleteLink($tagFormLi) {

        var $removeFormA = $('<td><a class="removeVentaUnitaria" href="#" ><img src="../bundles/puntoventa/images/delete.ico"></a></td>');
        $tagFormLi.append($removeFormA);

        $removeFormA.on('click', function(e) {
            e.preventDefault();
            $tagFormLi.remove();
        });
    }

    function addTagForm(collectionHolder) {
        // get the new index
        var index = collectionHolder.data('index');

        //Enviar el indice al controlador para
        // establecer el arreglo de ventas unitarias
        alert(index);

        var newForm = "<td>Nueva Forma</td>";

        // increase the index with one for the next item
        collectionHolder.data('index', index + 1);

        var $newFormLi = $('<tr class="ventaUnitaria"></tr>').append(newForm);
        addTagFormDeleteLink($newFormLi);
        collectionHolder.append($newFormLi);        
    }