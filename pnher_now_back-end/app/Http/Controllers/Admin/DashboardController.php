<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Baggage;
use App\Models\Company;
use App\Models\Feedback;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role ;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCompanies = Company::count();
        $totalBaggages = Post::count();
        $allFeedbacks = Feedback::count();
        $news = Baggage::where('delivery_status_id', 5)->get();
        $delivery = Baggage::with('deliveryStatus')
            ->where('delivery_status_id', 5)
            ->count();
        $instock = Baggage::with('deliveryStatus')
            ->where('delivery_status_id', 3)
            ->count();
        $itemdetail = Baggage::with('deliveryStatus')
            ->where('delivery_status_id', 3)
            ->count();

        // Count deliverers with the same branch as the supervisor
        $deliverer = Role::where('name', 'deliverer')->count();
        return view('dashboard', ['totalUsers' => $totalUsers, 'totalCompanies' => $totalCompanies, 'totalBaggages' => $totalBaggages, 'allFeedbacks' => $allFeedbacks, 'news' => $news, 'delivery' => $delivery, 'instock' => $instock, 'itemdetail' => $itemdetail,'deliverer'=>$deliverer]);
    }
}
