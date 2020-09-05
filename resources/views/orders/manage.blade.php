@extends('layouts.main')

@section('content')

<div class="fade-in">
  @include('partials.errors')
  @include('partials.success')
  <div class="card">
    <div class="card-header">
      <strong>{{ $title }}</strong>
      <div class="card-header-actions">
        <a href="{{ route('orders.add') }}"><i class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-responsive-lg">
        <thead>
          <tr>
            <th>#</th>
            <th>Ordered By</th>
            <th>Deliver At</th>
            <th>Items</th>
            <th>Sub Total</th>
            <th>Discount</th>
            <th>Payable</th>
            <th>Created At</th>
            <th>Controls</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              @php
                $customer = $order->customer()->first()
              @endphp
              <td><strong>{{ $customer->name }}</strong> ({{ $customer->contact }})</td>
              <td>
                @if ($order->deliver_at)
                  {{ $order->deliver_at->format('d M Y H:i') }}
                @else
                  N/A
                @endif
              </td>
              <td>
                <ul>
                  @php
                    $subTotal = 0;
                  @endphp
                  @foreach ($order->products()->get() as $item)
                    <li>
                      {{ $item->pivot->quantity }} x {{ $item->name }}
                      @php
                        $subTotal += ($item->price * $item->pivot->quantity)
                      @endphp
                    </li>
                  @endforeach
                </ul>
              </td>
              <td>
                {{ $subTotal }}
              </td>
              <td>{{ $order->discount }} %</td>
              <td>
                {{ $subTotal - ($subTotal * ($order->discount / 100)) }}
              </td>
              <td>{{ $order->created_at->format('d M Y H:i') }}</td>
              <td>
                <a href="{{ route('orders.view', ['id' => $order->id]) }}" class="btn btn-outline-primary btn-sm"><span class="fas fa-search"></span></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $orders->links() }}
    </div>
  </div>
</div>
    
@endsection