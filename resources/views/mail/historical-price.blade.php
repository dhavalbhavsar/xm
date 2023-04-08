<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Historical Price</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<p>From {{ $formData['start_date']->format('Y-m-d') }} to {{ $formData['end_date']->format('Y-m-d') }}</p>
<br/>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Date</th>
        <th scope="col">Open</th>
        <th scope="col">High</th>
        <th scope="col">Low</th>
        <th scope="col">Close</th>
        <th scope="col">Volume</th>
    </tr>
    </thead>
    <tbody>
    @foreach($historicalPrices as $historicalPrice)
        <tr>
            <th scope="row">{{ $historicalPrice['date'] }}</th>
            <td>{{ $historicalPrice['open'] }}</td>
            <td>{{ $historicalPrice['high'] }}</td>
            <td>{{ $historicalPrice['low'] }}</td>
            <td>{{ $historicalPrice['close'] }}</td>
            <td>{{ $historicalPrice['volume'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
