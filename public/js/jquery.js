$(function(){
    $('#delete').on('click', function(){
        if(confirm('本当に削除しますか？')) {
            location.href = '/review.blade.php';
        }else {
            return false;
        }
    });
})