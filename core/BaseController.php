<?php

namespace Core;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as CoreController;

class BaseController extends CoreController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
