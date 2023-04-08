@extends('master')

@section('content')

{!! Form::open(['route' => 'historical.quotes', 'class' => 'form-horizontal']) !!}

<fieldset>

    <legend>Get Company Historical Data</legend>

    <div class="mb-3 required">
        {!! Form::label('company_symbol', 'Select Company Symbol', ['class' => 'form-label'] )  !!}
        {!!  Form::select('company_symbol', $companies,  null, ['class' => 'form-control company-symbols', 'required' => 'required' ]) !!}
        @if ($errors->has('company_symbol'))
            <span class="text-danger">{{ $errors->first('company_symbol') }}</span>
        @endif
    </div>

    <div class="mb-3 required">
        {!! Form::label('start_date', 'Start Date', ['class' => 'form-label']) !!}
        {!! Form::text('start_date', null, ['class' => 'form-control', 'placeholder' => 'Start Date', 'id' => 'start_date', 'required' => 'required', 'autocomplete' => 'off']) !!}
        @if ($errors->has('start_date'))
            <span class="text-danger">{{ $errors->first('start_date') }}</span>
        @endif
    </div>

    <div class="mb-3 required">
        {!! Form::label('end_date', 'End Date', ['class' => 'form-label']) !!}
        {!! Form::text('end_date', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'id' => 'end_date', 'required' => 'required', 'autocomplete' => 'off']) !!}
        @if ($errors->has('end_date'))
            <span class="text-danger">{{ $errors->first('end_date') }}</span>
        @endif
    </div>

    <div class="mb-3 required">
        {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email', 'required' => 'required', 'autocomplete' => 'off']) !!}
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>

    <!-- Submit Button -->
    {!! Form::submit('Submit', ['class' => 'btn btn-primary'] ) !!}

</fieldset>

{!! Form::close()  !!}

@endsection

@push('scripts')
    <script type="module">
        $('.company-symbols').select2();

        $("#start_date").datepicker({
            dateFormat: "yy-mm-dd",
            maxDate: new Date(),
            onSelect: function(dateText, inst){
                $("#end_date").datepicker("option","minDate", $("#start_date").datepicker("getDate"));
            }
        });

        $("#end_date").datepicker({
            dateFormat: "yy-mm-dd",
            maxDate: new Date(),
        });

    </script>
@endpush
