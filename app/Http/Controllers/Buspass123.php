<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reg;
use App\Profile;
use App\StudentPass;

use App\Passengerpass;
use App\Payment;
use Illuminate\Support\Facades\Session;
use App\Contact;
use App\Busroute;
use App\Pass;



class Buspass123 extends Controller
{
    // ---------------------------
    // REGISTER
    // ---------------------------
    public function registerForm()
    {
        return view('register');
    }

    public function formData(Request $req)
    {
        $reg = new Reg();
        $reg->name = $req->name;
        $reg->email = $req->email;
        $reg->no = $req->no;
        $reg->pass = $req->pass;
        $reg->save();

        return redirect()->route('login.form')->with('success', 'Register Successful!');
    }

    // ---------------------------
    // LOGIN
    // ---------------------------
    public function loginForm()
    {
        return view('login');
    }

    public function loginCheck(Request $req)
{
    $req->validate([
        'email'    => 'required|email',
        'password' => 'required'
    ]);

    $user = Reg::where('email', $req->email)
                ->where('pass', $req->password) // pass mat change karo, input 'password' hai
                ->first();

    if ($user) {
        Session::put('userid', $user->id);
        Session::put('username', $user->name);

        return redirect()->route('dashbord'); // spelling same rehna chahiye
    }

    return back()->with('error', 'Invalid Email or Password');
}

//////////////////
////////////
//////////
  public function dashboard()
{
    $userId = Session::get('userid');

    // User ke saare passes fetch karo (Approved + Pending)
    $passes = Pass::where('user_id', $userId)
                  ->orderBy('created_at', 'desc')
                  ->get();

    return view('dashbord', compact('passes'));
}

    // ---------------------------
    // LOGOUT
    // ---------------------------
    public function logout()
    {
        Session::flush();
        return redirect()->route('login.form');
    }

    // ---------------------------
    // CONTACT PAGE
    // ---------------------------
    public function contact()
    {
        return view('contact');
    }

   public function submit(Request $req)
{
    Contact::create([
        'name' => $req->name,
        'email' => $req->email,
        'phone' => $req->phone,
        'subject' => $req->subject,
        'message' => $req->message
    ]);

    return back()->with('success', 'Your message has been sent successfully!');
}


    // ---------------------------
    // STUDENT PASS
    // ---------------------------



public function bookForm()
{
    $routes = Busroute::select('from')->distinct()->get();
    return view('book', compact('routes'));
    
}

   public function showForm()
{
    $routes = Busroute::select('from')->distinct()->get();
    return view('studpass', compact('routes'));
}


   public function saveForm(Request $req)
{
    $req->validate([
        'mobile' => 'required',
        'email' => 'required|email',
    ]);

    $pass = new Pass();
    $pass->pass_type = 'student';  
    $pass->user_id = Session::get('userid');

    // student fields
    $pass->fill($req->all());

    // Pricing
    $route = Busroute::where('from', $req->from_location)
                      ->where('to', $req->to_location)
                      ->first();

    $basePrice = $route->local_student_price;
    $pass->price = ($req->pass_duration == "Monthly") ? $basePrice :
                   ($req->pass_duration == "Quarterly") ? $basePrice * 3 :
                   $basePrice * 12;

    // Uploads
    foreach (['aadhaar','bonafide','photo','signature','ration'] as $file) {
        if ($req->hasFile($file)) {
            $filename = time() . '-' . $file . '.' . $req->file($file)->getClientOriginalExtension();
            $req->file($file)->move('uploads/docs/', $filename);
            $pass->$file = $filename;
        }
    }

    $pass->save();
    Session::put('current_pass_id', $pass->id);
return redirect()->route('payment.page');


    return redirect()->route('dashbord')->with('success', 'Student Pass Submitted!');
}

public function getTo($from)
{
    $routes = Busroute::where('from', $from)->get();

    return response()->json($routes);
}
public function applyPass()
{
    $routes = Busroute::select('from')->distinct()->get();
    return view('applay', compact('routes'));
}
public function myPasses()
{
    $passes = Pass::where('user_id', Session::get('userid'))
                  ->orderBy('created_at', 'desc')
                  ->get();

    return view('mypass', compact('passes'));
}


    // ---------------------------
    // PASSENGER PASS
    // ---------------------------
    public function passengerForm()
{
    $routes = Busroute::select('from')->distinct()->get();
    return view('passengerpass', compact('routes'));
}


    public function savePassenger(Request $req)
{
    $pass = new Pass();
    $pass->pass_type = 'passenger';  
    $pass->user_id = Session::get('userid');

    $pass->fill($req->all());

    // Uploads
    foreach (['aadhaar','photo','signature'] as $file) {
        if ($req->hasFile($file)) {
            $filename = time() . '-' . $file . '.' . $req->file($file)->getClientOriginalExtension();
            $req->file($file)->move('uploads/docs/', $filename);
            $pass->$file = $filename;
        }
    }

    // ✅ FIRST SAVE (ID generate hoti hai)
    $pass->save();

    // ✅ NOW id available
    Session::put('current_pass_id', $pass->id);

    return redirect()->route('payment.page')
        ->with('success', 'Passenger Pass Submitted! Please complete payment.');
}


    // ---------------------------
    // PAYMENT
    // ---------------------------
    public function payindex()
    {
        return view('pay');

    }



public function paystore(Request $req)
{
    $req->validate([
        'method' => 'required'
    ]);

    Payment::create([
    'user_id' => Session::get('userid'),
    'pass_id' => Session::get('current_pass_id'),
    'method' => $req->method,
    'card_number' => $req->card_number,
    'card_holder' => $req->card_holder,
    'expiry' => $req->expiry,
    'upi_id' => $req->upi_id,
    'status' => 'success'
]);


    return redirect()->route('dashbord')
        ->with('success', 'Payment Successful');
}



    // ---------------------------
    // PROFILE
    // ---------------------------
public function profileForm()
{
    $user_id = Session::get('userid');

    // user id check
    if (!$user_id) {
        return redirect('/login')->with('error', 'Please login first');
    }

    // REG table se user ka data lao
    $data = Reg::where('id', $user_id)->first();

    // agar record hi na mile
    if (!$data) {
        return redirect('/login')->with('error', 'User data not found!');
    }

    return view('profile', compact('data'));
}


public function profileSave(Request $req)
{
    $user_id = Session::get('userid');
    $reg = Reg::find($user_id);

    if (!$reg) {
        return back()->with('error', 'User not found!');
    }

    // PHOTO Upload
    if ($req->hasFile('photo')) {
        $file = $req->file('photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/profile/', $filename);
        $reg->photo = $filename;
    }

    // Update fields
    $reg->name = $req->name;
    $reg->email = $req->email;

    // ⚠ Old field (NULL allowed only if migration done)
    if ($req->phone != null) {
        $reg->no = $req->phone;
    }

    $reg->phone = $req->phone;
    $reg->dob = $req->dob;
    $reg->gender = $req->gender;
    $reg->city = $req->city;
    $reg->address = $req->address;
    $reg->pincode = $req->pincode;

    $reg->save();

    return back()->with('success', 'Profile Updated Successfully!');
}



    // ---------------------------
    // PASS VIEW PAGE
    // ---------------------------
  

public function showPass($id)
{
    $data = Pass::where('id', $id)
                ->where('user_id', Session::get('userid'))
                ->first();

    if (!$data) {
        return back()->with('error', 'Pass Not Found!');
    }

    return view('pass', compact('data'));
}
public function findByIcard(Request $req)
{
    $req->validate([
        'icard_no' => 'required'
    ]);

    $pass = Pass::where('icard_no', $req->icard_no)->first();

    if (!$pass) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid I-Card Number'
        ]);
    }

    // Renewal ke liye session me store
    Session::put('renew_pass_id', $pass->id);

    return response()->json([
        'status' => true,
        'data' => $pass
    ]);
}
// ---------------------------
// DELETE USER
// ---------------------------
public function deleteUser($id)
{
    $user = Reg::find($id);

    if (!$user) {
        return back()->with('error', 'User not found');
    }

    // User ke saare passes lao
    $passes = Pass::where('user_id', $id)->get();

    foreach ($passes as $pass) {

        // ❌ PAYMENT DELETE NAHI KARENGE
        // Payment history preserve rahegi

        // Delete uploaded files
        foreach (['aadhaar','bonafide','photo','signature','ration'] as $file) {
            if ($pass->$file && file_exists(public_path('uploads/docs/'.$pass->$file))) {
                unlink(public_path('uploads/docs/'.$pass->$file));
            }
        }

        // Delete pass
        $pass->delete();
    }

    // Delete profile photo
    if ($user->photo && file_exists(public_path('uploads/profile/'.$user->photo))) {
        unlink(public_path('uploads/profile/'.$user->photo));
    }

    // Delete user
    $user->delete();

    return back()->with('success', 'User deleted. Payment history preserved.');
}


}
