<html>
    <head></head>
    <body>
        <div style="display: table; width: 100%; text-align: center; height: 40px; background: #68A4C4; color: #fff; font-family: 'Open Sans', Arial, sans-serif; font-size: 14px; font-weight: bold;">
            <div style="display: table-cell; vertical-align: middle;">Новый заказ на подарочную карту!</div>
        </div>
        <div>
            <div style="width: 100%; text-align: center;">Дата первого торжества: <strong>{!! $sender->date_1 !!}</strong></div>
            <div style="width: 100%; text-align: center;">Название первого торжества: <strong>{!! $sender->celebrate_1 !!}</strong></div>
            <div style="width: 100%; text-align: center;">Дата второго торжества: <strong>{!! $sender->date_2 !!}</strong></div>
            <div style="width: 100%; text-align: center;">Название второго торжества: <strong>{!! $sender->celebrate_2 !!}</strong></div>
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