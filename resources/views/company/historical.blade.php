@extends('master')
@section('content')
    <a href="{{ route('company.historical') }}" class="btn btn-primary">Back</a>
    <h4>Company - {{ $company->companyName.' - ('.$company->symbol.')' }} <small>From {{ $data['start_date'] }} to {{ $data['end_date'] }}</small></h4>
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
        @forelse($histories['history_prices'] as $historyPrice)
            <tr>
                <th scope="row">{{ $historyPrice['date'] }}</th>
                <td>{{ $historyPrice['open'] }}</td>
                <td>{{ $historyPrice['high'] }}</td>
                <td>{{ $historyPrice['low'] }}</td>
                <td>{{ $historyPrice['close'] }}</td>
                <td>{{ $historyPrice['volume'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" align="center">No data found</td>
            </tr>
        @endforelse

        </tbody>
    </table>
    <div style="width: 800px;"><canvas id="historical"></canvas></div>
@endsection
@push('scripts')
    <script type="module">
        (async function() {
            const openDataSet = {!! json_encode($histories['chart']['open']) !!};

            const closeDataSet = {!! json_encode($histories['chart']['close']) !!};;

            new Chart(
                document.getElementById('historical'),
                {
                    type: 'line',
                    data: {
                        labels: openDataSet.map(row => row.date),
                        datasets: [
                            {
                                label: 'Open',
                                data: openDataSet.map(row => row.price)
                            },
                            {
                                label: 'Close',
                                data: closeDataSet.map(row => row.price)
                            }
                        ]
                    }
                }
            );
        })();
    </script>
@endpush
