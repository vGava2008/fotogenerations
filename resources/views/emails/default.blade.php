<html>
    <head></head>
    <body>
        <div style="display: table; width: 100%; text-align: center; height: 40px; background: #68A4C4; color: #fff; font-family: 'Open Sans', Arial, sans-serif; font-size: 14px; font-weight: bold;">
            <div style="display: table-cell; vertical-align: middle;">Новый заказ на подарочную карту!</div>
        </div>
        <div>
            <div style="width: 100%; text-align: center;">Данные отправителя: {!! $sender->name_from !!}</div>
            <div style="width: 100%; text-align: center;">Данные получателя: {!! $sender->name_to !!}</div>
            <div style="width: 100%; text-align: center;">Торжество: {!! $sender->triumph !!}</div>
            <div style="width: 100%; text-align: center;">Номинал карты: {!! $sender->nominal !!}</div>
            <div style="width: 100%; text-align: center;">Когда отправить карту: {!! $sender->date_send !!}</div>
            <div style="width: 100%; text-align: center;">Скрыть номинал: 
                @if(isset($sender->hide_nominal))
                    Да
                @else
                    Нет
                @endif
            </div>

            <div style="width: 100%; text-align: center;">Карта в электронном виде: 
                @if(isset($sender->card_electro))
                    Да
                @else
                    Нет
                @endif
            </div>
            <div style="width: 100%; text-align: center;">Карта в конверте: 
                @if(isset($sender->card_convert))
                    Да
                @else
                    Нет
                @endif
            </div>
            <div style="width: 100%; text-align: center;">Текст поздравления: {!! $sender->congratulation_text !!}</div>
        </div>
        <div style="display: table; width: 100%; text-align: center; height: 40px; background: #68A4C4; color: #fff; font-family: 'Open Sans', Arial, sans-serif; font-size: 14px; font-weight: bold;">
            <div style="display: table-cell; vertical-align: middle;">E-mail для связи: 
                @if(isset($sender->email))
                    {{ $sender->email }}
                @else
                    Не указано
                @endif
            </div>
        </div>
    </body>
</html>