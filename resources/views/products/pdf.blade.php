<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>


    <!-- Bootstrap core CSS -->
    {{--    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">--}}
    {{--    <link href="{{ asset('css/list-groups.css') }}" rel="stylesheet">--}}
    {{--    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">--}}
    {{--    <link href="{{ asset('css/table.css') }}" rel="stylesheet">--}}
    <style>
        .page-break {
            page-break-after: always;
        }

        body {
            font-family: "DejaVu Sans";
            color: #1a1e21;
            /*font: normal 12px/20px SansSerif;*/
        }

        .title {
            background: #6c757d;
            color: white;
            border-bottom: 5px solid white;


        }


        .link {
            text-decoration: none;
            font-size: 20px;
            color: #1a1e21;
            display: block;
            text-align: start;
            vertical-align: middle;


        }

        .header {
            font-size: 20px;
            display: block;
            margin-top: 10px;
            text-align: center;
            font-weight: 700;
            padding: 3px;

        }

        .img {
            float: left;
        }

        .text-center {
            text-align: center;
            vertical-align: middle;
        }

        .text-start {
            align-self: start;
        }

        .ul-left {
            display: inline-block;
            text-align: left;

        }

        table {
            width: 100%; /* Ширина таблицы */
            table-layout: fixed;
            border-collapse: collapse; /* Убираем двойные линии */
            /*border-bottom: 2px solid #333; !* Линия снизу таблицы *!*/
            /*border-top: 2px solid #333; !* Линия сверху таблицы *!*/
        }

        td {
            /*border-bottom: 1px solid #333;*/
            border-top: 1px solid #333;
        }

        td, th {
            padding: 5px; /* Поля в ячейках */
            width: unset;
        }

        th {
            background: #dedddd
        }

        .float-left{
            float: left;
        }
        .text-small{
            font-size: 12px;
        }
        .padding-bottom-15{
            padding-bottom: 15px;
        }
        .papping-top-5{
            padding-top: 5px;
        }
    </style>
    <title>Сравнение покрытий</title>

</head>
<body>
<main>
    <a class="link" href="{{ route('home') }}">
        <img class="img" width="50" height="50" src="{{ public_path('mstile-150x150.png') }}" alt="{{env('APP_NAME')}}">
        <div align="justify" class="padding-bottom-15">
            <div class="float-left">{{env('APP_NAME')}}</div> <div  class="text-small papping-top-5" align="right">Дата: {{ now('Asia/Yekaterinburg')->format('d.m.Y, H:i') }}</div>
        </div>
    </a>
    <hr>
    <table>
        <caption class="header">Сравнение покрытий (Основные свойства)</caption>

        @foreach($fieldsToShow as $field => $cyrillic)
            @if($field === 'title')
                <tr>
                    @foreach($products as $product)
                        <th class="title">{{ Str::upper($product->$field) }}</th>
                    @endforeach
                </tr>
            @else
                <tr>
                    <th colspan="{{ count($products) }}"> {!! $cyrillic !!}</th>
                </tr>
                <tr>
                    @foreach($products as $product)
                        <td class="text-center">
                            @if($product->$field === true){{'Да'}}
                            @elseif($product->$field === false or $product->$field === 0){{'Нет'}}
                            @else {{$product->$field}}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endif
        @endforeach
    </table>

    <div class="page-break"></div>

    <a class="link" href="{{ route('home') }}">
        <img class="img" width="50" height="50" src="{{ public_path('mstile-150x150.png') }}" alt="{{env('APP_NAME')}}">
        <div align="justify" class="padding-bottom-15">
            <div class="float-left">{{env('APP_NAME')}}</div> <div  class="text-small papping-top-5" align="right">Дата: {{ now() }}</div>
        </div>
    </a>
    <hr>
    <table>
        <caption class="header">Сравнение покрытий (Дополнительные свойства)</caption>
        <tr>
            @foreach($products as $product)
                <th class="title">{{ Str::upper($product->title) }}</th>
            @endforeach
        </tr>
        @foreach($linkedFields as $relations => $cyrillic)
            <tr>
                <th colspan="{{ count($products) }}"> {!! $cyrillic !!}</th>
            </tr>
            <tr>
                @foreach($products as $product)
                    <td class="text-center">
                        <div class="text-start">
                            @if(!count($product->$relations))
                                {{ 'Нет' }}
                            @else
                                <ul type="disc" class="ul-left">

                                    @foreach($product->$relations as $relation)
                                        <li>
                                            {{Str::ucfirst($relation->title)}}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </td>
                @endforeach
            </tr>
        @endforeach
    </table>



</main>

</body>
</html>

