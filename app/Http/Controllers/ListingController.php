<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\List_;

class ListingController extends Controller
{

    // Show all listings
    public function index()
    {
        return view('listings.index', [
            "listings" => Listing::latest()->filter(request(["tag", "search"]))->paginate(6)
        ]);
    }

    // Show single listing
    public function show(Listing $listing)
    {
        return view("listings.show", [
            "listing" => $listing
        ]);
    }

    // Show create job form
    public function create()
    {
        return view("listings.create");
    }

    // Store listing data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => ['required', "url"],
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => ['required', "min:10"]
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect("/")->with("message", "Listing created!");
    }

    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => ['required', "url"],
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => ['required', "min:10"]
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with("message", "Listing updated!");
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect("/")->with("message", "Listing deleted!");
    }
}
