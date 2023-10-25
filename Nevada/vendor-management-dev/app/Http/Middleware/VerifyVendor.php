<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user->hasRole('Vendor') || $user->vendor->status !== 'Verified') {
            return back();
        }

        if ($request->tender->status !== 'Open') {
            return back();
        }

        if ($request->tender->tenderVendors
            ->where('vendor_id', $user->vendor->id)->first()) {
            return back();
        }

        return $next($request);
    }
}
