drag_drop()
// --------set class on focuse and remove class on focuseout for input and textarea -----------------
$('input').each(function(){
    if($( this ).val()!='') {
        $(this).parent().addClass('is-focused')
      }
      else{
        $(this).parent().removeClass('is-focused')
      }
})

  if($( "textarea" ).val()!='') {
    $(this).parent().addClass('is-focused')
  }
