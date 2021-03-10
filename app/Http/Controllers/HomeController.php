<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      if(\Auth::user()->isAdmin())
      {
        return redirect('/statistics');
      }
      elseif(\Auth::user()->isCompany())
      {
          return redirect('/statistics');
      }
      elseif(\Auth::user()->isObserver())
      {
          return redirect('/statistics');
      }
      else
      {
        return view('home');
      }

    }
}
