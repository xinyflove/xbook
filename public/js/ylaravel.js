$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});

var editor = new wangEditor('content');
if (editor.config)
{
    editor.config.uploadImgUrl = '/posts/image/upload';

    // 设置 headers（举例）
    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    };

    editor.create();
}

$('.preview_input').change(function (event) {
    var file = event.currentTarget.files[0];
    var url = window.URL.createObjectURL(file);
    $(event.target).next('.preview_img').attr('src', url);
});

$('.like-button').click(function (event) {
    var target = $(event.target);
    var current_like = target.attr('like-value');
    var user_id = target.attr('like-user');

    if (current_like == 1)
    {
        // 取消关注
        $.ajax({
            url: '/user/' + user_id + '/unfan',
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.error != 0)
                {
                    alert(data.msg);
                    return;
                }

                target.attr('like-value', 0);
                target.text('关注');
                target.removeClass('btn-default').addClass('btn-primary');
            }
        });
    }
    else
    {
        // 关注
        $.ajax({
            url: '/user/' + user_id + '/fan',
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.error != 0)
                {
                    alert(data.msg);
                    return;
                }

                target.attr('like-value', 1);
                target.text('取消关注');
                target.removeClass('btn-primary').addClass('btn-default');
            }
        });
    }
});