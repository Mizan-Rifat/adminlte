@extends('adminlte::page')

@section('plugins.Datatables', true)

@php

    $allFields = config("datatypes.".pluralDatatype($dataType))['fields'];

@endphp

@section('title', pluralTitle($dataType))

@section('content_header')
    <h1>{{ pluralTitle($dataType) }}</h1>

    <x-topAction 
        {{-- :route="get_route(pluralDatatype($dataType),'create')" --}}
        :dataType='$dataType' 
    />
    
@stop

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif

@include('admin.partials.table')

@endsection


@section('css')
@stop


@section('js')
<script>

$(document).ready(function() {
        $('#example').DataTable( {
            "order": [],
            'columnDefs': [
                {
                    'targets': 0,
                    'searchable':false,
                    'orderable':false,

                },
            ],
        });


        $('#deleteBtn').click(function(e) {
            e.preventDefault();
            $('#myTable').submit();
        })
        
        $('#bulkSelect').click(function(e) {
         
                $('.checkboxes').each(function() {
                    $(this).prop('checked',e.target.checked)
                });
            
        })


    } );
    
</script>
@stop