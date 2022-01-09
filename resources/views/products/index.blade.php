@extends('layouts.app')

@section('title')
    All Products
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All Products') }}</div>

                    <div class="card-body">
                        @include('_include')
                        <a href="{{ route('products.create') }}" class="btn btn-success float-right">{{ __('Add new Product') }}</a>
                        <a href="{{ route('orders.create') }}" class="btn btn-success float-right">{{ __('New Order') }}</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <th scope="row" class="text-danger">{{ $loop->iteration }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>>
                                    </tr>
                                @empty
                                    <p>No products Yet</p>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
