<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function greetings()
    {
        $greetings = ['hello'=>'MacPaw Internship 2022!'];
        return json_encode($greetings);
    }
}
