<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPrdcast;
use App\Mail\OrderShipped;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {


    }
}
