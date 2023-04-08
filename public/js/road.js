
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
        $('.loading').addClass('display-none');
        console.log('ok');
        console.log(data);
        let html = 'test';

        $.each(data, function () {
            let product_name = $(this).product_name();
            let price = $(this).price();
            let stock = $(this).stock();
            let company_id = $(this).company_id();
            html = `
               
    <tr class='table-row'>
        <td>${id}</td>
        <td><img src="{{asset('storage/${img_path}')}}" style=" max-width: 100%;" alt=""></td>
        <td>${product_name}</td>
        <td>${price}</td>
        <td>${stock}</td>
        <td>${company_id}</td>
        <td><a href="/adm/public/product/${id} ">詳細</a></td>
        <td><button type="button" class="btn btn-primary" onclick="location.href='/adm/public/product/edit/${id} '">編集</button></td>
        <form method="POST" action="{{ route('delete',${id} " onSubmit="return checkDelete()" enctype="multipart/form-data">
            @csrf
            <td><button type="submit" class="btn btn-primary" onclick="">削除</button></td>
    </tr>
    @endforeach

         `;
            $('.user-table').append(html);
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

