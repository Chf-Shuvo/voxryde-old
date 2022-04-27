<?php

namespace App\Http\Controllers\customer;

use App\Models\Driver;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerDriver;
use App\Models\CustomerDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $customers = Customer::latest()->get();
            return view("backend.content.customer.index", compact("customers"));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "phone" => "required|unique:customers",
            "company_registration" => "required|unique:customers",
        ]);
        try {
            Customer::create([
                "customer_name" => $request->customer_name,
                "email" => $request->email,
                "password" => Hash::make("123456"),
                "phone" => $request->phone,
                "image" => "customer.png",
                "address" => $request->address,
                "company_name" => $request->company_name,
                "company_registration" => $request->company_registration,
                "company_address" => $request->company_address,
                "status" => $request->status,
            ]);
            toast(
                "Customer added successfully. Customer Default Password is: 123456",
                "success"
            );
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $customer = Customer::find($id);
            $documents = CustomerDocument::where("customer_id", $id)
                ->latest()
                ->get();
            return view(
                "backend.content.customer.show",
                compact("customer", "documents")
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        try {
            return view("backend.content.customer.edit", compact("customer"));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        try {
            $customer->update($request->except("_token", "_method"));
            toast("Customer updated successfully!");
            return redirect()->route("customer.index");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function status($id)
    {
        try {
            $customer = Customer::find($id);
            $status = !$customer->getRawOriginal("status");
            $customer->update([
                "status" => $status,
            ]);
            toast("Status changed successfully", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function destroy($customer)
    {
        try {
            $customer = Customer::with("drivers", "documents")->find($customer);
            // remove documents
            foreach ($customer->documents as $customerDocument) {
                Storage::disk("public")->delete(
                    "customer_documents/" . $customerDocument->document
                );
            }
            $customer->delete();
            toast("Customer deleted successfully.", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function reset_password(Customer $customer)
    {
        try {
            $customer->update([
                "password" => Hash::make("123456"),
            ]);
            toast(
                "Password reset successful. Default Password is: 123456",
                "success"
            );
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function document_store(Request $request)
    {
        try {
            $file = $request->file("document");
            $fileExtension = $file->getClientOriginalExtension();
            $fileName =
                time() .
                "_customer_" .
                $request->customer_id .
                "." .
                $fileExtension;
            Storage::disk("public")->put(
                "customer_documents/" . $fileName,
                file_get_contents($file)
            );
            CustomerDocument::create([
                "customer_id" => $request->customer_id,
                "document_name" => $request->title,
                "document" => $fileName,
                "expiry_date" => $request->expiry_date,
            ]);
            toast("Document uploaded successfully", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function document_destroy($id)
    {
        try {
            $customerDocument = CustomerDocument::find($id);
            Storage::disk("public")->delete(
                "customer_documents/" . $customerDocument->document
            );
            $customerDocument->delete();
            toast("Document deleted successfully", "success");
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
