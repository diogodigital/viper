<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Traits\Providers\SlotegratorTrait;
use Illuminate\Http\Request;

class SlotegratorController extends Controller
{
    use SlotegratorTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function selfValidationMethod()
    {
        return $this->selfvalidation();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function webhookMethod(Request $request)
    {
        return $this->webhooks($request);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function limitMethod()
    {
        return $this->limits();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
