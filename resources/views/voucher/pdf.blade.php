<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $ticket->code }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap');

        body {
            font-family: 'Merriweather Sans', sans-serif;
            padding: 10px;
        }

        .title {
            font-weight: bold;
            text-align: center;
        }

        h2 {
            color: #a00318;
        }

        h3 {
            font-weight: bold;

        }

        p {
            font-weight: bold;
        }

        span {
            font-weight: 700;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;

        }

        .total {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .total-pay {
            margin-bottom: 0px;
            text-align: center;
        }

        .method-pay {
            color: #a9a9a9;
            font-weight: bold;
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class=" title">Comprobante de Reserva de Pasaje: {{ $ticket->code }}</h1>
    <div>
        <h3>Viajes Turjoy</h3>
        <h3>Fecha:
            <span>{{ $date }}</span>
        </h3>
    </div>
    <div>
        <h2>Datos del concierto</h2>
        <p>Codigo de reserva:
            <span>{{ $ticket->code}}</span>
        </p>
        <p>Ciudad de origen:
            <span>{{ $ticket->travelDates->origin }}</span>
        </p>
        <p>Ciudad de destino:
            <span>{{ $ticket->travelDates->destination }}</span>
        </p>
        <p>Dia de la reserva:
            <span>{{ $ticket->date }}</span>
        </p>
        <p>Cantidad de asientos:
            <span>{{ $ticket->seat}}</span>
        </p>
        <p>Fecha de la compra:
            <span>{{ $date }}</span>
        </p>
    </div>
    <hr>
    <div class="total">
        <p class="total-pay">Total pagado: {{ $ticket->total }}</p>
    </div>
</body>

</html>
