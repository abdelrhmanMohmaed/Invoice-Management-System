<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Customer\CustomerStoreRequest;
use App\Http\Requests\Website\Customer\CustomerUpdateRequest;
use App\Models\Customer;
use Exception;
use Response;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);

        return response()->customResponse(
            true,
            $customers,
            'Customers fetched successfully.',
            200,
            $customers->total(),
            $customers->nextPageUrl(),
            $customers->previousPageUrl()
        );
    }

    public function store(CustomerStoreRequest $request)
    {
        try {
            $this->authorize('create', Customer::class);

            $validated               = $request->validated();

            $customer = Customer::create($validated);

            return Response::customResponse(
                true,
                $customer,
                'Customer created successfully.'
            );

        } catch (Exception $e) {
            \Log::error('Customer Store Error: ' . $e->getMessage());
            return Response::errorResponse('Something went wrong. Please try again!', 500);
        }
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        try {
            $this->authorize('update', $customer);

            $validated               = $request->validated();

            $customer->update($validated);

            return Response::customResponse(
                true,
                $customer,
                'Customer updated successfully.'
            );
        } catch (Exception $e) {
            \Log::error('API Customer Update Error: ' . $e->getMessage());
            return Response::errorResponse('Something went wrong. Please try again!');
        }
    }

    public function destroy(Customer $customer)
    {
        try {
            $this->authorize('delete', $customer);

            $customer->delete();

            return Response::customResponse(
                true,
                null,
                'Customer deleted successfully.'
            );
        } catch (Exception $e) {
            \Log::error('API Customer destroy Error: ' . $e->getMessage());
            return Response::errorResponse('Something went wrong. Please try again!');
        }
    }
}
