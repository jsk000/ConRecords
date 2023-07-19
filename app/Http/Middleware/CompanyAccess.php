<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CompanyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requested_company_id = $request->route('company')->company_id; 
        $user = auth()->user();

        // Check if the user is admin or the company ID matches the requested company ID
        if (!$user->is_admin || $user->c_id !== $requested_company_id) {
            return redirect()->back(); // Redirect back to the same page
        }else{
            return $next($request);
        }
    
        
    }
}
