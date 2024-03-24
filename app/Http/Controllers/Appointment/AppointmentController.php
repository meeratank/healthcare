<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Appointment;
use App\Http\Requests\AppointmentStoreRequest;

class AppointmentController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();
        $appointments = Appointment::where('user_id', $user['id'])
            ->paginate(request()->all());

        $data['appointment'] = $appointments;
        $response = [
            'status' => 'success',
            'data' => $data,
        ];

        return response()->json($response, 201);
    }

    public function store(AppointmentStoreRequest $request)
    {
        $booked_slot = Appointment::where('healthcare_professional_id', $request->healthcare_professional_id)
            ->where('appointment_start_time', '<=', $request->appointment_start_time)
            ->where('appointment_end_time', '>=', $request->appointment_start_time)
            ->orWhere(function ($query) use ($request) {
                $query->where('appointment_start_time', '<=', $request->appointment_end_time)
                    ->where('appointment_end_time', '>=', $request->appointment_end_time);
            })
            ->first();

        if ($booked_slot) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Slot not Available!',
            ], 403);
        }


        $user = $request->user();

        $appointment = Appointment::create([
            'user_id' => $user['id'],
            'healthcare_professional_id' => $request->healthcare_professional_id,
            'appointment_start_time' => $request->appointment_start_time,
            'appointment_end_time' => $request->appointment_end_time,
            'status' => 'booked',
        ]);
        $data['appointment'] = $appointment;


        $response = [
            'status' => 'success',
            'message' => 'Appointment is created successfully.',
            'data' => $data,
        ];

        return response()->json($response, 201);
    }

    public function update_status(Appointment $appointment, $status)
    {
        $appointment_start_time = new \DateTime($appointment->appointment_start_time);
        $comparetime = new \DateTime(date("Y-m-d H:i:s"));
        $cancellation_interval = $appointment_start_time->diff($comparetime);
        $completion_interval = $comparetime->diff($appointment_start_time);

        if ($status == 'cancelled' && $cancellation_interval->format('%h') < 24) {
            return response()->json([
                'status' => 'failed',
                'message' => 'appointment can only cancel before 24hr',
            ], 403);
        }

        if ($status == 'completed' && $completion_interval->format('%r%i') > 0) {
            return response()->json([
                'status' => 'failed',
                'message' => 'appointment can only completed after start time ',
            ], 403);
        }
        $appointment->status = $status;
        $appointment->save();

        $response = [
            'status' => 'success',
            'message' => 'Appointment ' . $status . ' successfully'
        ];

        return response()->json($response, 201);
    }
}
