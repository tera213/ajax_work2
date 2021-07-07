$(function(){

    $('.js-valid-email').on('keyup', function(e){

        let $that = $(this);

        $.ajax({
            type : 'post',
            url : 'ajax.php',
            dataType : 'json',
            data : {
                email : $(this).val()
            }
        }).then(function(data){

            if(data){
                console.log(data);

                if(data.errorFlg){
                    $('.js-msg-area').addClass('is-error');
                    $('.js-msg-area').removeClass('is-success');
                    $that.addClass('is-error');
                    $that.removeClass('is-success');
                }else{
                    $('.js-msg-area').addClass('is-success');
                    $('.js-msg-area').removeClass('is-error');
                    $that.addClass('is-success');
                    $that.removeClass('is-error');
                }

                $('.js-msg-area').text(data.msg);
            }
        })
    })
})