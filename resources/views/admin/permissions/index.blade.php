@extends('adminlte::page')

@section('title', 'Dashboard')
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

    <div class="d-flex justify-content-center mb-3">

        

            <div class="col-6 ">
                <!-- <div class="input-group input-group-sm"> -->
                    <form action="{{ route('generate_permissions') }}" method="post" class="input-group input-group">
                    @csrf    
                        <input 
                            type="text" 
                            class="form-control"
                            placeholder="Table Name"
                            name="tableName"
                        
                        >
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat">Generate Permissions</button>
                        </span>
                    </form>
                <!-- </div> -->
            </div>
        

    </div>

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