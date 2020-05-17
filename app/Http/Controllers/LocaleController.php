<?php namespace App\Http\Controllers;
use Redirect;
use Illuminate\Http\Request;
use App\Jobs\ChangeLocale;

class LocaleController extends Controller {


	public function __construct()
    {
        
    }


    public function language(Request $request)
    {
        $changeLocale = new ChangeLocale($request->input('lang'));
        $this->dispatch($changeLocale);

        return redirect()->back();
    }

}