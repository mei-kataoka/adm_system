
$(document).on('click', '#searchBtn', function () {
    alert("クリックされました");

    let searchId = $('#searchName').val();

    if (!searchId) {
        return false;
    }
    $.ajax({
        type: 'GET',
        url: '/adm/public/product/search/',
        cache: false,
        data: {
            'keyword': searchId, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
        },
        dataType: 'text',

    }).done(function (data) {//通信が成功したばあい
        $('.table-row').empty();
        console.log('ok');
        console.log(data);
        let html = 'test';

        $.each(data, function (index, value) {
            console.log(index + ': ' + value);
        });

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

