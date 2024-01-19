<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getServices()
    {
        $services = ServiceResource::collection(Service::all());

        return response()->json([
           'service'=>$services
        ]);
    }
    public function getService($id)
    {
        $service = Service::find($id);
        $service = ServiceResource::make($service);

        return response()->json([
           'service'=>$service
        ]);
    }
    public function createService(ServiceRequest $request)
    {

        $service = Service::create($request->all());
        $service = ServiceResource::make($service);

        return response()->json([
           'service'=>$service
        ]);
    }
    public function updateService($id, ServiceRequest $request)
    {
        $service = Service::find($id);
        $service->update($request->all());
        $service->save();
        $service = ServiceResource::make($service);

        return response()->json([
           'service'=>$service
        ]);
    }
    public function deleteService($id)
    {
        $service = Service::find($id);
        $service->delete();

        return response()->json([
           'services'=>$this->getServices(),
        ]);
    }
}
