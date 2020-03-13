@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif

<section class="gift-card">
            <div class="title">
                <h2>Подарочная карта</h2>
            </div>
            <div class="title-p">
                <p>Сомневаетесь в выборе подарка? Подарочный сертификат - легкий способ дарить подарки!</p>
                <p>Просто выберите сумму подарка, а именинник сам выберет себе картину и подберет оформление на свой вкус.</p>
            </div>
            <div class="gift-card-content">
                <div class="card clearfix">
                    <div class="card-item">
                        <img src="../img/card-item1.png" alt="">
                    </div>
                    <div class="card-item">
                        <img src="../img/card-item2.png" alt="">
                    </div>
                </div>
                <div class="card-form">
                    <form id="feedbackform" method="GET"  action="/sendgiftcard">
                    	
                    	<input type="hidden" name="_method" value="put" >
                    	{{ csrf_field() }}
    <div id="sendmessage" style="display: none;">
        Ваше сообщение отправлено!
    </div>
    <div id="senderror" style="display: none;">
        При отправке сообщения произошла ошибка. Продублируйте его, пожалуйста, на почту администратора <span>{{ env('MAIL_ADMIN_EMAIL') }}</span>
    </div>
                        <div class="form-content clearfix">
                            <div class="form-item">
                                <div class="input">
                                    <div class="select clearfix">
                                        <div>
                                            <label>Выберите номинал:</label>
                                            <select name="nominal" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                                                <option>1500</option>
                                                <option>1500</option>
                                                <option>1500</option>
                                                <option>1500</option>
                                                <option>1500</option>
                                            </select>
                                            <i>Или укажите свою сумму</i>
                                        </div>
                                        <div>
                                            <label>Когда отправить:</label>
                                            <select name="date_send" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                                                <option>2019-05-24</option>
                                                <option>2019-05-24</option>
                                                <option>2019-05-24</option>
                                                <option>2019-05-24</option>
                                                <option>2019-05-24</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-c">
                                        <label>Скрыть номинал</label>
                                        <input name="hide_nominal" type="checkbox">
                                    </div>
                                </div>
                                <div class="input-name clearfix">
                                    <div>
                                        <label>Данные отправителя:</label>
                                        <input name="name_from" type="text" placeholder="Ваше Имя">
                                        <i>От кого подарок</i>
                                    </div>
                                    <div>
                                        <label>Данные получателя:</label>
                                        <input name="name_to" type="text" placeholder="Ваше Имя">
                                        <i>Для кого</i>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label>Карта в электронном виде</label>
                                    <input name="card_electro" type="checkbox" checked>
                                </div>
                                <div class="checkbox">
                                    <label>Карта в конверте</label>
                                    <input name="card_convert" type="checkbox">
                                </div>
                            </div>
                            <div class="form-item">
                                <div class="input">
                                    <label>Торжество:</label>
                                    <input name="triumph" type="text">
                                    <i>Напишите с чем поздравлять</i>
                                </div>
                                <div class="input">
                                    <label>Текст поздравления</label>
                                    <textarea name="congratulation_text"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit"><span>Оформить и оплатить</span></button>
                        <p>Заполняя форму я соглашаюсь с <a href="javascript:void(0)"> условиями политики конфеденциальности</a></p>
                        <p>Подарочная карта действует на любые товара из нашей студии!</p>
                    </form>
                </div>
            </div>
        </section>