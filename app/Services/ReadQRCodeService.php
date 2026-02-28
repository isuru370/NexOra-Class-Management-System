<?php

namespace App\Services;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class ReadQRCodeService
{
    public function readQRCode(Request $request)
    {
        // Validate request
        $request->validate([
            'custom_id' => 'required|string'
        ]);

        try {

            // Find student by custom_id
            $student = Student::where('custom_id', $request->custom_id)
                ->where('student_disable', false)
                ->first();

            if (!$student) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Student not found'
                ], 404);
            }

            if ($student->is_active == 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Student is inactive'
                ], 403);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'QR Code scanned successfully',
                'student_id' => $student->id,
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function studentIdCardActive($custom_id)
    {
        try {
            // Find the student by custom_id
            $student = Student::where('custom_id', $custom_id)->first();

            if (!$student) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Student not found',
                ], 404);
            }

            // Update the flags
            $student->update([
                'permanent_qr_active' => true,
                'student_disable' => false,
                'is_active' => true,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Student QR activated successfully',
                'student_id' => $student->id,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to activate student QR',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
