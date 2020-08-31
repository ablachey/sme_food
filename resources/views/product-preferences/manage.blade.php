@extends('layouts.main')

@section('content')

<div class="fade-in">
  @include('partials.errors')
  @include('partials.success')
  <div class="card">
    <div class="card-header">
      <strong>{{ $title }}</strong>
      <div class="card-header-actions">
        <a href="{{ route('product-preferences.add') }}"><i class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-responsive-lg">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Controls</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($productPreferences as $productPreference)
            <tr>
              <td>{{ $productPreference->id }}</td>
              <td>{{ $productPreference->name }}</td>
              <td></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
    
@endsection