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

        var $removeFormA = $('<td><a class="removeVentaUnitaria" href="#" ><img src='+ deleteIcoPath +'></a></td>');
        $tagFormLi.append($removeFormA);

        $removeFormA.on('click', function(e) {
            e.preventDefault();
            $tagFormLi.remove();
        });
    }

    function addTagForm(collectionHolder) {
        //Enviar el indice al controlador para
        // establecer el arreglo de ventas unitarias
        var index = collectionHolder.data('index');

        $.ajax({
            type: "POST",
            data: {index: index},
            url: ajaxAddUnitSaleUrl,
            success: function (data) {
                collectionHolder.data('index', index + 1);

                var $newFormLi = $('<tr class="ventaUnitaria"></tr>').append(data);
                addTagFormDeleteLink($newFormLi);
                collectionHolder.append($newFormLi);
            }
        });


    }