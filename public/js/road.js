

window.addEventListener('DOMContentLoaded', function () {

    $('#searchBtn').on('click', function () {
        alert("クリックされました");

        let searchId = $('#searchName').val();
        console.log(searchId);
        if (!searchId) {
            return false;
        }
        $.ajax({
            type: 'GET',
            url: '/adm/public/productSearch',
            cache: false,
            data: {
                'searchName': searchId, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
            },
            dataType: 'text',

        }).done(function (data) {//通信が成功したばあい
            $('.user-table tbody').empty();
            $('.loading').addClass('display-none');
            console.log('ok');
            let html = '';
            $.each(data, function (index, data) {
                console.log(data);
                html = '<p>あ</p>'

            })

            html = '<p>あ</p>'
            $('.user-table tbody').append(html);
        }).fail(function (jqXHR, textStatus, errorThrown) { // 通信が失敗したときの処理
            alert('ファイルの取得に失敗しました。');
            console.log("ajax通信に失敗しました");
            console.log("jqXHR          : " + jqXHR.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        }).always(function (data) {
            //通信の成否にかかわらず実行する処理 
        });
    });
});
