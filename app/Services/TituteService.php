<?php

namespace App\Services;

use App\Models\Titute;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class TituteService
{
    /**
     * Fetch titute records with filters
     */
    

    /**
     * Store new titute
     */
    

    /**
     * Update titute
     */
    

    /**
     * Soft delete (status = 0)
     */
    public function delete(int $id): bool
    {
        $titute = Titute::findOrFail($id);

        return $titute->update([
            'status' => 0,
        ]);
    }

    /**
     * Duplicate check helper
     */
    protected function ensureNoDuplicate(
        int $studentId,
        int $classCategoryStudentClassId,
        Carbon $month,

    ): void {
        $query = Titute::where('student_id', $studentId)
            ->where(
                'class_category_has_student_class_id',
                $classCategoryStudentClassId
            )
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->where('status', 1);


        if ($query->exists()) {
            throw ValidationException::withMessages([
                'titute' => 'Titute already exists for this student, class, and month.',
            ]);
        }
    }

    public function checkTitute(
        int $studentId,
        int $classCategoryStudentClassId,
        Carbon $month,
    ) {
        $query = Titute::where('student_id', $studentId)
            ->where(
                'class_category_has_student_class_id',
                $classCategoryStudentClassId
            )
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->where('status', 1);

        return response()->json([
            'status' => 'success',
            'exists' =>$query->exists() ? true : false,
            
        ]);
    }
}
