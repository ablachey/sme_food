@extends('layouts.main')

@section('content')

<div class="fade-in">
  @include('partials.errors')
  @include('partials.success')
  <div class="card">
    <div class="card-header">
      <strong>{{ $title }}</strong>
      <div class="card-header-actions">
        <a href="{{ route('products.add') }}"><i class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        @foreach ($products as $product)
          <div class="col-sm-4">
            <div class="card">
              <div class="card-header">
                <strong>{{ $product->name }}</strong>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12 text-center">
                    <a href="{{ route('products.view', ['id' => $product->id]) }}">
                      @if ($product->image)
                        <img class="img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                      @else
                        <img class="img-fluid" src="{{ asset('img/img_placeholder.png') }}" alt="{{ $product->name }}">
                      @endif
                    </a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 pt-2 pb-2">
                    <button class="btn btn-success">{{ $product->type()->first()->name }}</button>
                    <button class="btn btn-warning">MVR{{ number_format($product->price, 2) }}</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 prod-pref">
                    @if ($product->preferences()->count() > 0)
                      @foreach ($product->preferences()->get() as $pref)
                        <span class="badge badge-secondary">{{ $pref->name }}</span>
                      @endforeach
                    @endif
                  </div>
                </div>
              
              </div>
              <div class="card-footer">
                <a href="{{ route('products.view', ['id' => $product->id]) }}" class="btn btn-outline-primary">View <span class="fas fa-search"></span></a>
                <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-outline-primary">Edit <span class="fas fa-pen"></span></a>
                <a href="{{ route('products.delete', ['id' => $product->id]) }}" class="del-conf btn btn-outline-primary">Delete <span class="fas fa-trash"></span></a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="row">
        <div class="col-sm-12">
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </div>
  @include('partials.delete-confirm-modal');
</div>
    
@endsection