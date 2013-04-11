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
        var $removeFormA = $('<td><a class="removeVentaUnitaria" href="#" ><img src="bundles/puntoventa/images/delete.ico"></a></td>');
        $tagFormLi.append($removeFormA);

        $removeFormA.on('click', function(e) {
            e.preventDefault();
            $tagFormLi.remove();
        });
    }

    function addTagForm(collectionHolder) {
        // Get the data-prototype explained earlier
        var prototype = collectionHolder.data('prototype');

        // get the new index
        var index = collectionHolder.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        collectionHolder.data('index', index + 1);

        var $newFormLi = $('<tr class="ventaUnitaria"></tr>').append(newForm);
        addTagFormDeleteLink($newFormLi);
        collectionHolder.append($newFormLi);        
    }