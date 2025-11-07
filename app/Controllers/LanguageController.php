<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class LanguageController extends Controller
{
    public function changeLanguage($lang)
{
    $session = session();
    $session->set('lang', $lang);
    return redirect()->back();
}

    // Di dalam controller
public function index()
{
    // Memastikan bahasa di-set dari session
    $lang = session()->get('lang') ?? 'en';
    return view('admin/dashboard', ['lang' => $lang]);
}

}
