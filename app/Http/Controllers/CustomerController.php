<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Customer;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\ConfirmRequest;

class CustomerController extends Controller
{
  public function index(Request $request) {
    $title = 'Customers';

    $customers = collect();
    $q = '';

    if($request->has('q') && $request->q != '') {
      $q = $request->q;
      $customers = Customer::where('name', 'LIKE', '%' . $q . '%')
                              ->orWhere('contact', 'LIKE', '%' . $q . '%')
                              ->orWhere('address', 'LIKE', '%' . $q . '%')
                              ->orderBy('name', 'asc')
                              ->paginate(10);
    }
    else {
      $customers = Customer::orderBy('name', 'asc')->paginate(10);
    }
    

    return view('customers.manage', compact('title', 'customers', 'q'));
  }

  public function create() {
    $title = 'Add Customer';

    return view('customers.add', compact('title'));
  }

  public function store(CustomerRequest $request) {
    $customer = Customer::create($request->validated());

    return redirect()->route('customers')->with(['success' => 'Customer added successfully']);
  }

  public function search(Request $request) {
    $request->validate(['keyword' => 'required']);

    $keyword = $request->keyword;

    $customers = Customer::where('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('contact', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('address', 'LIKE', '%' . $keyword . '%')
                            ->limit(10)
                            ->get();

    return response()->json(['data' => CustomerResource::collection($customers)], 200);
  }

  public function edit($id) {
    $title = 'Edit Customer Details';
    $model = Customer::findOrFail($id);

    return view('customers.edit', compact('title', 'model'));
  }

  public function update(CustomerRequest $request, $id) {
    $customer = Customer::findOrFail($id);
    $customer->update($request->all());

    return redirect()->route('customers')->with(['success' => 'Customer details updated successfully.']);
  }

  public function destroy(ConfirmRequest $request, $id) {
    $customer = Customer::findOrFail($id);
    $customer->delete();

    return redirect()->route('customers')->with(['success' => 'Customer removed successfully.']);
  }
}
