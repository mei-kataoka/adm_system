
$(document).on('click', '#searchBtn', function () {


    let searchId = $('#keyword').val();
    let categoryId = $('#categoryId').val();
    let stockUp = $('#stockUp').val();
    let stockDawn = $('#stockDawn').val();


    $.ajax({
        type: 'GET',
        url: '/adm/public/product/search/',
        cache: false,
        data: {
            'keywordId': searchId,
            'categoryId': categoryId,
            'stockUp': stockUp,
            'stockDawn': stockDawn,

            //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
        },


    }).done(function (data) {//通信が成功したばあい
        $('.table-row').empty();
        console.log(data);
        $('.loading').addClass('display-none');
        let html = 'test';
        if (data == null) {
            $('.table-row').empty();
        }
        $.each(data, function (index, value) {


            let id = value.id;
            let company_id = value.company_id;
            let product_name = value.product_name;
            let price = value.price;
            let stock = value.stock;
            let img_path = value.img_path;

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
      <td>
                <button id='deleteBtn' class="btn btn-info search-icon btn-primary" value='${id}'>削除</button>
        </td>
  </tr>
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




//削除

$(document).on('click', '#deleteBtn', function () {
    let clickEle = $(this);
    let productId = clickEle.attr('value');
    console.log(productId);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var deleteConfirm = confirm('削除してよろしいでしょうか？');
    if (deleteConfirm == true) {



        $.ajax({
            type: 'POST',
            url: '/adm/public/product/delete',
            dataType: "text",
            data: {
                'id': productId,
                '_method': 'DELETE' /// DELETE リクエストとつたえてる
            },

        }).done(function (data) {//通信が成功したばあい

            clickEle.parents('tr').remove();
            console.log(data);



        }).fail(function (jqXHR, textStatus, errorThrown) { // 通信が失敗したときの処理
            alert('ファイルの取得に失敗しました。');
            console.log("ajax通信に失敗しました");
            console.log("jqXHR          : " + jqXHR.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        }).always(function (data) {


        });
    } else {
        (function (e) { e.preventDefault() });
    }
});

