<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecordAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requested_project = $request->route('project'); 
        $requested_record = $request->route('record');
        $user = auth()->user();

        // Check if the user is the assigned engineer for the project, an admin of the same company, and the record belongs to the project
         if (
            (($user->user_id === $requested_project->u_id) ||
            ($user->is_admin && $user->c_id === $requested_project->c_id)) &&
            ($requested_record->p_id === $requested_project->project_id)
        ){
            return $next($request);
        }else{
            return redirect()->back(); // Redirect back to the previous page
    }
  }
}
