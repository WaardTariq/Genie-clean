<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function promoCodeIndex()
    {
        $promos = PromoCode::where('status',1)->get();
        return view('admin.promo-code.all',compact('promos'));
    }

    public function createPromoCode()
    {
        return view('admin.promo-code.add');
    }

    public function storePromoCode(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:promo_codes,code',
            'discont_type' => 'required|in:fixed,percentage',
            'discount_value' => 'required|numeric|min:1',
            'start_at' => 'required|date',
            'expire_at' => 'required|date|after:start_at',
            'usage_limit' => 'nullable|integer|min:1',
            'per_user_limit' => 'nullable|integer|min:1',
            'is_unlimited' => 'nullable|boolean',
        ]);

        $promo = new PromoCode();
        $promo->title = $request->title;
        $promo->code = $request->code;
        $promo->discount_type = $request->discont_type;
        $promo->discount_value = $request->discount_value;
        $promo->starts_at = $request->start_at;
        $promo->expires_at = $request->expire_at;
        if ($request->is_unlimited == 1) {
            $promo->usage_limit = 'unlimited';
            $promo->per_user_limit = 'unlimited';
        } else {
            $promo->usage_limit = $request->usage_limit;
            $promo->per_user_limit = $request->per_user_limit;
        }
        $promo->save();

        return redirect()->back()->with('modal-success', 'Promo code created successfully!');

    }
}
