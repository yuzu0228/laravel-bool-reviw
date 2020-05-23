$(function(){
    
    $('#search-nav-btn').on('click', function(){
        $('#search-wrapper').addClass('open');
        $('html').css({
            overflow: 'hidden',
        });
    });
    
    $('#close-btn').on('click', function(){
        $('#search-wrapper').removeClass('open');
        $('html').css({
            overflow: 'visible',
        });
    });
    
    $('.nav-item.nav-category').hover(function(){
        $('>ul:not(:animated)', this).fadeIn('fast')
            }, function(){
                $('>ul', this).fadeOut('fast');
			});
    
})

function delete_alert(e){
   if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルされました'); 
      return false;
   }
   document.deleteform.submit();
};