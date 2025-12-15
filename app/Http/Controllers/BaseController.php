<?php

namespace App\Http\Controllers;

use App\Contracts\ControllerInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as MainController;

abstract class BaseController extends MainController implements ControllerInterface
{
    use AuthorizesRequests {
        authorize as protected baseAuthorize;
    }
    use DispatchesJobs, ValidatesRequests;

    public function authorize($ability, $arguments = [])
    {
        $admin = auth('admin')->user();

        if ($admin) {
            return $this->authorizeForUser($admin, $ability, $arguments);
        }

        return $this->baseAuthorize($ability, $arguments);
    }
}
