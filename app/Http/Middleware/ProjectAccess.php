<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $requested_project_c_id = $request->route('project')->c_id; 
        $user = auth()->user();

        // Check if the user is admin and the  user company ID matches the requested engineer company ID
        if (!$user->is_admin || $user->c_id !== $requested_project_c_id) {
            return redirect()->back(); // Redirect back to the same page
        }else{
            return $next($request);
        }
    
    }
}
