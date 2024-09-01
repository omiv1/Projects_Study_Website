<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\Deal;
//use Illuminate\Http\Request;
//
//class DealController extends Controller
//{
//    public function index()
//    {
//        $deals = Deal::orderby('created_at', 'asc')->get();
//        return view('deals.index', ['deals' => $deals]);
//    }
//
//    public function addDeal()
//    {
//        $deal = new Deal;
//        return view('addDealForm', ['deal' => $deal]);
//    }
//
//    public function store2(Request $request)
//    {
//        $this->validate($request, [
//            // Tutaj powinny być reguły walidacji dla twojego formularza
//        ]);
//
//        $deal = new Deal;
//        // Tutaj powinny być przypisane wartości do atrybutów modelu Deal
//        if ($deal->save()) {
//            return redirect('deals');
//        }
//        return view('addDealForm');
//    }
//    public function store(Request $request)
//    {
//        $deal = new Deal;
//
//        $deal->manufacturer = $request->input('manufacturer');
//        $deal->deal_link = $request->input('deal_link');
//        $deal->image_link = $request->input('image_link');
//        $deal->model = $request->input('model');
//        $deal->name = $request->input('name');
//        $deal->product_code = $request->input('product_code');
//        $deal->category_id = $request->input('category_id');
//        $deal->subcategory_id = $request->input('subcategory_id');
//        $deal->price = $request->input('price');
//        $deal->added_at = $request->input('added_at');
//
//        // Przekształć wartość 'on' na 1 i brak wartości na 0
//        $deal->shadow = $request->has('shadow') ? 1 : 0;
//
//        if ($deal->save()) {
//            return redirect('deals');
//        }
//        return view('addDealForm');
//    }
//

//
//    public function edit($id) {
//        $deal = Deal::find($id);
//        return view('editDealForm', ['deal'=>$deal]);
//    }
//
//    public function update(Request $request, $id)
//    {
//        $deal = Deal::find($id);
//        // Tutaj powinny być przypisane nowe wartości do atrybutów modelu Deal
//        if($deal->save()) {
//            return redirect()->route('deals');
//        }
//        return "Wystąpił błąd.";
//    }
//
//    public function destroy($id)
//    {
//        $deal = Deal::find($id);
//        if($deal->delete()){
//            return redirect()->route('deals');
//        }
//        else return back();
//    }
//}


namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;
use App\Models\DealUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;



class DealController extends Controller
{
    public function index()
    {
        $deals = Deal::all();
        return view('deals', ['deals' => $deals]);
    }
    public function getSubcategories($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();
        $html = '<option value="">(Select)</option>';
        foreach ($subcategories as $subcategory) {
            $html .= '<option value="'.$subcategory->id.'">'.$subcategory->name.'</option>';
        }
        return response()->json(['html' => $html]);
    }

    public function create()
    {
        $categories = Category::all(); // Fetch all categories from the database
        $subcategories = SubCategory::all(); // Fetch all subcategories from the database
        $deal = new Deal;
        return view('addDealForm', ['deal' => $deal, 'categories' => $categories, 'subcategories' => $subcategories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'manufacturer' => 'required|string',
            'deal_link' => 'required|url',
            'image_link' => 'required|url',
            'model' => 'required|string',
            'name' => 'required|string',
            'product_code' => 'required|string',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $deal = new Deal;
        $deal->manufacturer = $request->manufacturer;
        $deal->deal_link = $request->deal_link;
        $deal->image_link = $request->image_link;
        $deal->model = $request->model;
        $deal->name = $request->name;
        $deal->product_code = $request->product_code;
        $deal->category_id = $request->category_id;
        $deal->subcategory_id = $request->subcategory_id;
        $deal->price = $request->price;
        $deal->shadow = $request->has('shadow'); // This will be false if the checkbox was not checked
        $deal->user_id = auth()->id();
        $deal->save();

        if ($deal->save()) {
            return redirect('deals');
        }
        return view('addDealForm');
    }
    public function rate(Request $request)
    {
        $dealId = $request->input('deal_id');
        $points = $request->input('points');
        $userId = Auth::id();

        // Sprawdź, czy użytkownik już ocenił tę okazję
        $vote = DealUser::where('user_id', $userId)->where('deal_id', $dealId)->first();

        if ($vote) {
            // Jeśli użytkownik już ocenił tę okazję, zaktualizuj jego ocenę tylko jeśli punkty są różne
            // lub usuń ocenę, jeśli punkty są takie same
            if ($vote->points != $points) {
                $deal = Deal::find($dealId);
                // Odejmij poprzednie punkty od punktów okazji
                $dealPoints = $deal->points - $vote->points;
                // Zaktualizuj punkty oceny
                $vote->points = $points;
                $vote->save();
                // Dodaj nowe punkty do punktów okazji
                $dealPoints += $points;
                // Zaktualizuj punkty okazji bez zmiany pola updated_at
                $deal->update(['points' => $dealPoints], ['timestamps' => false]);
            } else {
                $deal = Deal::find($dealId);
                // Odejmij punkty od punktów okazji
                $dealPoints = $deal->points - $vote->points;
                // Usuń ocenę
                $vote->delete();
                $points = 0; // Ustaw punkty na 0, aby zaktualizować stan przycisków
                // Zaktualizuj punkty okazji bez zmiany pola updated_at
                $deal->update(['points' => $dealPoints], ['timestamps' => false]);
            }
        } else {
            // Jeśli użytkownik jeszcze nie ocenił tej okazji, dodaj nowy rekord
            $vote = new DealUser;
            $vote->user_id = $userId;
            $vote->deal_id = $dealId;
            $vote->points = $points;
            $vote->save();

            // Zaktualizuj punkty okazji
            $deal = Deal::find($dealId);
            $dealPoints = $deal->points + $points;
            // Zaktualizuj punkty okazji bez zmiany pola updated_at
            $deal->update(['points' => $dealPoints], ['timestamps' => false]);
        }

        return response()->json(['points' => $deal->points, 'user_points' => $points]);
    }

    public function deal($id)
    {
        $deal = Deal::find($id);
        $userId = Auth::id();

        // Get the user's vote for this deal
        $vote = DealUser::where('user_id', $userId)->where('deal_id', $id)->first();

        // Pass the $user_vote variable to the view
        return view('deal', ['deal' => $deal, 'user_vote' => $vote ? $vote->points : 0]);
    }
    public function show($id)
    {
        $deal = Deal::find($id);
        $userId = Auth::id();

        // Pobierz ocenę użytkownika dla tej okazji
        $vote = DealUser::where('user_id', $userId)->where('deal_id', $id)->first();

        // Przekazanie zmiennej $user_vote do widoku
        return view('deal', ['deal' => $deal, 'user_vote' => $vote ? $vote->points : 0]);
    }

    public function destroy(Deal $deal)
    {
        $deal->delete();
        return redirect()->route('deals')->with('success', 'Okazja została usunięta');
    }

}
