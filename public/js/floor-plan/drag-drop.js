// ---------function drag drop------------------
drag_drop()
function drag_drop(){
    var $gallery = $( "#gallery" )
            $table_td=$('#table>tr>td')
          // Let the gallery items be draggable
          $( "div", $gallery ).draggable({
            // cancel: "a.ui-icon", // clicking an icon won't initiate dragging
                revert: "invalid", // when not dropped, the item will revert back to its initial position
                containment: "document",
                helper: "clone",
                cursor: "move"
          });
        //   -----droppable---------
          $c=0
          $('.some-td').droppable({
                accept: "#gallery > div",
                classes: {
                      "ui-droppable-active": "ui-state-highlight"
                },
                drop: function( event, ui ) {
        // deleteImage( ui.draggable );

                $c++
                        $l=event.target
                        console.log($l)
                        $clone_div=ui.draggable.clone()
                        $(event.target).html($clone_div)
                        $clone_div.append('<input class="form-control quantity-chair text-center" type="number" name="mm-'+$c+'" placeholder="quantity chair" required="true" aria-required="true" aria-invalid="true">')
                        $clone_div.prepend('<div class="w-100 text-right x px-3">x</div>')
                        if($('.width').val()>4 || $('.height').val()>4){
                            $('#table>tr>td>div>img').css('width', '60%')
                        }
                    }
                });
}
