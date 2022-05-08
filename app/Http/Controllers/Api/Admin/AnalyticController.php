<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;

class AnalyticController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'is_admin']);
    }
    
    public function index()
    {
        return response()->json([
            'mostVisitedPages' => Analytics::fetchMostVisitedPages(Period::days(7)),
            'visitors' => Analytics::fetchVisitorsAndPageViews(Period::days(7)),
            'visitorsMonthly' => Analytics::fetchVisitorsAndPageViews(Period::months(1)),
            'userType' => Analytics::fetchUserTypes(Period::days(7)),
        ]);
    }
}
