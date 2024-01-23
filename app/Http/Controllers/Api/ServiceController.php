<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index():JsonResponse
    {
        $services = ServiceResource::collection(Service::all());

        return response()->json([
           'service'=>$services
        ]);
    }
    public function show($id): JsonResponse
    {
        $service = Service::find($id);
        $service = ServiceResource::make($service);

        return response()->json([
           'service'=>$service
        ]);
    }
    public function store(ServiceRequest $request): JsonResponse
    {

        $service = Service::create($request->all());
        $service = ServiceResource::make($service);

        return response()->json([
           'service'=>$service
        ]);
    }
    public function update($id, ServiceRequest $request): JsonResponse
    {
        $service = Service::find($id);
        $service->update($request->all());
        $service->save();
        $service = ServiceResource::make($service);

        return response()->json([
           'service'=>$service
        ]);
    }
    public function destroy($id): JsonResponse
    {
        $service = Service::find($id);
        $service->delete();

        return response()->json([
           'services'=>$this->getServices(),
        ]);
    }
}
