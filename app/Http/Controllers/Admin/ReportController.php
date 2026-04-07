<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use App\Models\MedicalRecord;
use App\Models\MedicinalHerb;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Tổng quan
        $totalPatients = Patient::count();
        $totalMedicalRecords = MedicalRecord::count();
        $totalPrescriptions = Prescription::count();
        
        $totalHerbs = MedicinalHerb::count();
        $lowStockHerbs = MedicinalHerb::where('quantity_in_stock', '>', 0)->where('quantity_in_stock', '<=', 10)->count();
        $outOfStockHerbs = MedicinalHerb::where('quantity_in_stock', 0)->count();
        // Sắp hết hạn (<= 30 ngày)
        $expiringHerbs = MedicinalHerb::whereNotNull('expiry_date')
            ->where('expiry_date', '<=', Carbon::now()->addDays(30))
            ->where('expiry_date', '>=', Carbon::now())
            ->count();
        $expiredHerbs = MedicinalHerb::whereNotNull('expiry_date')
            ->where('expiry_date', '<', Carbon::now())
            ->count();

        $totalArticles = Article::count();
        $totalComments = Comment::count();

        // 2. Thống kê theo 6 tháng gần nhất
        $months = [];
        $patientStats = [];
        $prescriptionStats = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('m/Y');
            
            $patientStats[] = Patient::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
                
            $prescriptionStats[] = Prescription::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return view('admin.reports.index', compact(
            'totalPatients', 'totalMedicalRecords', 'totalPrescriptions',
            'totalHerbs', 'lowStockHerbs', 'outOfStockHerbs', 'expiringHerbs', 'expiredHerbs',
            'totalArticles', 'totalComments',
            'months', 'patientStats', 'prescriptionStats'
        ));
    }
}
