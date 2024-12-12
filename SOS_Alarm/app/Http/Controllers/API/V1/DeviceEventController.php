<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SIAEncoder;

class DeviceEventController extends Controller
{
    protected $siaEncoder;

    public function __construct(SIAEncoder $siaEncoder)
    {
        $this->siaEncoder = $siaEncoder;
    }

    /**
     * Send an encoded SIA message to the central station.
     */
    public function sendEvent(Request $request)
    {
        $request->validate([
            'eventCode' => 'required|string',
            'accountId' => 'required|string',
            'data' => 'required|string',
        ]);

        // Encode the event message
        $encodedMessage = $this->siaEncoder->encodeMessage(
            $request->eventCode,
            $request->accountId,
            $request->data
        );

        // Send the message (example of using HTTP or a TCP client)
        $response = Http::post('http://central-station-ip:port', [
            'message' => $encodedMessage,
        ]);

        return response()->json(['status' => $response->status(), 'message' => 'Event sent']);
    }
}
