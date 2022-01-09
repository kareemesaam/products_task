@extends('layouts.app')

@section('title')
    Add new Product
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add new Order') }}</div>

                    <div class="card-body">
                        @include('_include')

                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="name" class="form-label">{{__('Customer Name')}}</label>
                                <input type="text" name="customer_name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="category">{{ __('Select Product') }}*</label>
                                <select name="select_product" id="selectProduct" class="form-control auto-save"  required >
                                    <option value="">{{ __('Select') }} {{ __('Product') }}</option>
                                    @foreach($products as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-12">
                                    <table id="products" class="table">
                                        <thead>
                                        <tr>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Quantity')}}</th>
                                            <th>{{__('Delete')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">{{__('Save')}}</button>
                        </form>

                        <a href="{{ route('products.index') }}" class="btn btn-danger mt-3">{{__('Return to all products')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        let index = 1;
        // add selected products
        $('#selectProduct').change(function () {
            $('#selectProduct option:selected').hide();
            let id = $('#selectProduct').val();
            let name = $('#selectProduct option:selected').text();
            $('#products tbody').append('<tr><td><input type="hidden"  name="products[' + index + '][id] " value="' + id + '"><input type="text" class="form-control" name="products[' + index + '][name]" value="' + name + '" readonly></td><td><input name="products[' + index + '][quantity]" type="number" class="form-control" required></td><td><button type="button" class="btn btn-link" onclick="removeRow(this);">' + "{{ __('Delete') }}" + '</button></td></tr>');
            index++;
        });
        //delete product row
        function removeRow(el) {
            if (confirm("Are you sure?")) {
                $(el).parents('tr').parents('tbody').children().length <= 1 ? $('#selectProduct').val(null) :'';
                $(el).parents('tr').remove();
            }
            return false;
        }
    </script>
@stop
