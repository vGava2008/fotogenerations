@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif

<section class="stocks">
    <div class="title">
        <h2>Возможные скидки:</h2>
        <h5>ViarStudia</h5>
    </div>
    <div class="stocks-content">
        <div class="container">
            <div class="stocks-items clearfix">
                <div class="stocks-item">
                    <img src="../img/stocks-item-img1.png" alt="">
                    <h3 style="height: 46px;">Напишите две даты<i>i<span>Окно дня подсказки</span></i> </h3>
                    <p style="height: 50px;">Значимые для Вас <span>(что, когда)</span> и заблаговременно <strong>мы предложим Вам скидку
                            до 30%</strong></p>
                    <a class="datas_js" href="javascript:void(0)"><span>Указать даты</span></a>
                </div>
                <div class="stocks-item">
                    <img src="../img/stocks-item-img2.png" alt="">
                    <h3 style="height: 46px;">Пригласите друга сделать заказ<i>i<span>Окно дня подсказки</span></i> </h3>
                    <p style="height: 50px;">После того как друг осуществит заказ,<strong>Вам полагается скидка 5 €</strong></p>
                    <a class="friend_js" href="javascript:void(0)"><span>сгенерировать код</span></a>
                </div>
                <div class="stocks-item">
                    <img src="../img/stocks-item-img3.png" alt="">
                    <h3 style="height: 46px;">Пришлите нам PrintScreen<i>i<span>Окно дня подсказки</span></i> </h3>
                    <p style="height: 50px;">С публикацией на Facebook о нашем<strong>сайте и получите скидку</strong></p>
                    <a class="printScreen_js" href="javascript:void(0)"><span>Загрузить</span></a>
                </div>
            </div>
            <div class="send-data">
                <div class="text">
                    <h3>Картина 30х40 см <span>БЕСПЛАТНО!</span> В замен на красивую фотографию:</h3>
                    <ul>
                        <li>+ отзыв на сайте</li>
                        <li>+ отзыв на FB</li>
                        <li>+ выставить фото картины на FB с пометкой Viarcanvas</li>
                    </ul>
                    <a class="photo_js" href="javascript:void(0)"><span>Отправить данные</span></a>
                </div>
                <img src="../img/send-data-img.png" alt="">
            </div>
        </div>
    </div>
</section>