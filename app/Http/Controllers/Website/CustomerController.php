<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Customer\CustomerStoreRequest;
use App\Http\Requests\Website\Customer\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Exception;
use Illuminate\View\View;


class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = Customer::orderByDesc('id')->paginate(10);

        return view('website.customer.index', compact('customers'));
    }
    public function show(Customer $customer): View
    {
        return view('website.customer.show', compact('customer'));
    }
    public function create(): View
    {
        return view('website.customer.create');
    }
    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        try {
            Customer::create($request->validated());

            return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
        } catch (Exception $e) {
            \Log::error('Customer Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again!');
        }
    }
    public function edit(Customer $customer): View
    {
        return view('website.customer.edit', compact('customer'));
    }
    public function update(CustomerUpdateRequest $request, Customer $customer): RedirectResponse
    {
        try {
            $customer->update($request->validated());

            return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
        } catch (Exception $e) {
            \Log::error('Customer Update Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong. Please try again!');
        }
    }
    public function destroy(Customer $customer): RedirectResponse
    {
        try {

            $customer->delete();

            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
        } catch (Exception $e) {
            \Log::error('Customer destroy Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong. Please try again!');
        }
    }
}
