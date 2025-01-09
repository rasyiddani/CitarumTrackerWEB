<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Database as FirebaseDatabase;

class SettingController extends Controller
{
    public function updateLimit(Request $request)
    {
        try {
            DB::table('settings')
                ->update([
                    'under'         => $request->under,
                    'updated_at'    => date('Y-m-d H:i:s'),
                    'over'          => $request->over,
                    'value'         => $request->value,
                ]);

            return redirect()
                ->to('/settings')
                ->with(['success' => 'Limit berhasil diperbarui']);
        } catch (Exception $e) {
            Log::info($e);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan']);
        }
    }
}
