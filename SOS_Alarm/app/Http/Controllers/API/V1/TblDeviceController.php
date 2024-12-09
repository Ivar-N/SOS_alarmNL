<?php

namespace App\Http\Controllers\API\V1;

use App\Models\TblDevice;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatetblDeviceRequest;
use App\Http\Requests\StoretblDeviceRequest;

class DeviceController extends Controller
{
    // 1. List all devices for the authenticated user
    public function index(Request $request)
    {
        $devices = TblDevice::where('GebruikerID', $request->user()->id)->get();
        return response()->json(['devices' => $devices], 200);
    }

    // 2. Get details for a specific device
    public function show(TblDevice $device, Request $request)
    {
        // Ensure the device belongs to the authenticated user
        if ($device->GebruikerID !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        return response()->json(['device' => $device], 200);
    }

    // 3. Add a new device
    public function store(Request $request)
    {
        $request->validate([
            'AlarmCode' => 'required|string|max:255',
            'Longitude' => 'nullable|numeric',
            'Latitude' => 'nullable|numeric',
            'MapsLink' => 'nullable|string',
            'TelefoonnummerDevice' => 'required|string|max:15',
            'Batterijpercentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $device = TblDevice::create([
            'GebruikerID' => $request->user()->id,
            'AlarmCode' => $request->AlarmCode,
            'Longitude' => $request->Longitude,
            'Latitude' => $request->Latitude,
            'MapsLink' => $request->MapsLink,
            'TelefoonnummerDevice' => $request->TelefoonnummerDevice,
            'Batterijpercentage' => $request->Batterijpercentage,
        ]);

        return response()->json(['message' => 'Device added successfully', 'device' => $device], 201);
    }

    // 4. Update an existing device
    public function update(Request $request, TblDevice $device)
    {
        // Ensure the device belongs to the authenticated user
        if ($device->GebruikerID !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        $request->validate([
            'AlarmCode' => 'nullable|string|max:255',
            'Longitude' => 'nullable|numeric',
            'Latitude' => 'nullable|numeric',
            'MapsLink' => 'nullable|string',
            'TelefoonnummerDevice' => 'nullable|string|max:15',
            'Batterijpercentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $device->update($request->only([
            'AlarmCode', 
            'Longitude', 
            'Latitude', 
            'MapsLink', 
            'TelefoonnummerDevice', 
            'Batterijpercentage'
        ]));

        return response()->json(['message' => 'Device updated successfully', 'device' => $device], 200);
    }

    // 5. Delete a device
    public function destroy(TblDevice $device, Request $request)
    {
        // Ensure the device belongs to the authenticated user
        if ($device->GebruikerID !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        $device->delete();

        return response()->json(['message' => 'Device deleted successfully'], 200);
    }
}
