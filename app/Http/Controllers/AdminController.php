<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reg;
use App\Contact;
use App\Busroute;
use App\Pass;
use App\Admin;
use Carbon\Carbon;
use App\Payment;
use Illuminate\Support\Facades\Mail;
use App\Mail\PassStatusMail; 


class AdminController extends Controller
{
    // Approve Pass
    public function approvePass($id)
    {
        $pass = Pass::findOrFail($id);

        $pass->status = 'approved';

        // ✅ NEW (safe): expiry_date auto set if empty
        if (empty($pass->expiry_date)) {
            $pass->expiry_date = Carbon::now()->addMonth();
        }

        $pass->save();

        return back()->with('success','Pass approved!');
    }

    // Reject Pass
    public function rejectPass($id)
    {
        $pass = Pass::findOrFail($id);
        $pass->status = 'rejected';
        $pass->save();

        return back()->with('success','Pass rejected!');
    }
   public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:approved,rejected'
    ]);

    $pass = Pass::findOrFail($id);
    $pass->status = $request->status;
    $pass->save();

    // auto mail
    Mail::to($pass->email)->send(new PassStatusMail($pass));

    return back()->with('success', 'Pass '.$request->status.' successfully');
}

    public function loginCheck(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $admin = Admin::where('email', $request->email)
                  ->where('password', $request->password) // (plain password)
                  ->first();

    if ($admin) {
        session([
            'admin_logged_in' => true,
            'admin_id' => $admin->id
        ]);

        return redirect()->route('admin.dashboard');
    }

    return back()->with('error', 'Invalid Admin Credentials');
}


    // ================= DASHBOARD (GET + POST) =================
    public function dashboard(Request $request)
    {
         if (!session()->has('admin_logged_in')) {
        return redirect()->route('admin.login')
               ->with('error', 'Please login first');
    }
        // 💳 Payments with User & Pass
$payments = Payment::with(['user','pass'])
            ->latest()
            ->get();

        // ===== SETTINGS SAVE =====
        if ($request->isMethod('post')) {

            $request->validate([
                'system_name'   => 'required',
                'support_email' => 'required|email',
            ]);

            $admin = Admin::first();

            if ($admin) {
                $admin->update([
                    'system_name'   => $request->system_name,
                    'support_email' => $request->support_email,
                ]);
            }

            return back()->with('success', 'System settings updated');
        }

        // ===== DASHBOARD DATA (GET) =====

        $admin = Admin::first();

        // 👤 Total Users
        $userCount = Reg::count();

        // 💰 Total Revenue
        $revenue = Pass::where('status', 'approved')->sum('price');

        // 🎫 Total Bookings
        $bookingCount = Pass::count();

        // 🟢 Active Passes
        $activePassCount = Pass::where('status', 'approved')
            ->whereDate('expiry_date', '>=', Carbon::today())
            ->count();

        // Lists
        $users = Reg::latest()->get();
        $messages = Contact::latest()->get();
        $routes = Busroute::latest()->get();

        // ✅ CHANGE (safe): last 5 ki jagah ALL passes (design table ke liye)
        $passes = Pass::latest()->get();

        // ===== Analytics =====
        $todayBookings = Pass::whereDate('created_at', Carbon::today())->count();

        $totalRidesMonth = Pass::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $avgRevenuePerDay = Pass::where('status', 'approved')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
            ->avg('price');

        $satisfaction = 4.8;

        return view(
            'admin.deshbord',
            compact(
                'admin',
                'userCount',
                'bookingCount',
                'activePassCount',
                'revenue',
                'users',
                'messages',
                'routes',
                'passes',
                'todayBookings',
                'totalRidesMonth',
                'avgRevenuePerDay',
                'satisfaction',
                'payments'

            )
        );
    }

    // View all passes (unchanged)
    public function allPasses()
    {
        $passes = Pass::latest()->get();
        return view('admin.passes', compact('passes'));
    }

    // ================= ROUTES ==================
    public function routeStore(Request $req)
    {
        Busroute::create([
            'from'  => $req->from,
            'to'    => $req->to,
            'local_student_price'    => $req->local_student_price,
            'local_passenger_price'  => $req->local_passenger_price,
            'express_student_price'  => $req->express_student_price,
            'express_passenger_price'=> $req->express_passenger_price,
        ]);

        return back()->with('success', 'Route Added Successfully!');
    }

    public function routeUpdate(Request $req, $id)
    {
        $route = Busroute::findOrFail($id);

        $route->update([
            'from'  => $req->from,
            'to'    => $req->to,
            'local_student_price'    => $req->local_student_price,
            'local_passenger_price'  => $req->local_passenger_price,
            'express_student_price'  => $req->express_student_price,
            'express_passenger_price'=> $req->express_passenger_price,
        ]);

        return back()->with('success', 'Route Updated Successfully!');
    }

    public function routeDelete($id)
    {
        Busroute::findOrFail($id)->delete();
        return back()->with('success', 'Route Deleted Successfully!');
    }

    public function index()
    {
        $admin = Admin::first();

        return view('welcome', [
            'system_name'   => $admin->system_name ?? 'BusPass',
            'support_email' => $admin->support_email ?? 'support@example.com',
            'support_phone' => $admin->support_phone ?? '1-800-BUS-PASS',
        ]);
    }
}
