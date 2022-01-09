@extends('layouts.app')

@section('title')
    Add new Product
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add new Product') }}</div>

                    <div class="card-body">
                        @include('_include')

                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf

                            <label for="name" class="form-label">{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control">

                            <label for="price" class="form-label">{{__('price')}}</label>
                            <input type="number" name="price" class="form-control">

                            <label for="stock" class="form-label">{{__('stock')}}</label>
                            <input type="number" name="stock" class="form-control">



                            <button type="submit" class="btn btn-primary mt-3">{{__('Add')}}</button>
                        </form>

                        <a href="{{ route('products.index') }}" class="btn btn-danger mt-3">{{__('Return to all products')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
