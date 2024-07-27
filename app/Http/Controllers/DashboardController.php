<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $all_listings = Listing::where('is_deleted', false)
        ->count();
        
        $total_listings = Listing::where('userId', $user->id)
            ->where('is_deleted', false)
            ->count();

        $total_reservations = Reservation::where('userId', $user->id)
        ->count();
    
        return inertia('Dashboard', [
            'is_admin' => $user->is_admin,
            'all_listings' => $all_listings,
            'total_listings' => $total_listings,
            'total_reservations' => $total_reservations,
        ]);
    }

 
    public function listings(Request $request)
    {
        $user = auth()->user();
    
        if ($request->ajax())
        {
            $data = Listing::with(['state', 'location', 'category'])
            ->where('userId', $user->id)
            ->where('is_deleted', false)
            ->select('*');
    
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($data) 
                {
                    return $data->id;
                })
                ->addColumn('name', function ($data) 
                {
                    return $data->title;
                })
                ->addColumn('description', function ($data) 
                {
                    return $data->description;
                })
                ->addColumn('roomCount', function ($data) 
                {
                    return $data->roomCount;
                })
                ->addColumn('bathroomCount', function ($data) 
                {
                    return $data->bathroomCount;
                })
                ->addColumn('guestCount', function ($data) 
                {
                    return $data->guestCount;
                })
                ->addColumn('price', function ($data) 
                {
                    return $data->price;
                })
                ->addColumn('state', function ($data) 
                {
                    return $data->state->name;
                })
                ->addColumn('location', function ($data) 
                {
                    return $data->location->name;
                })
                ->addColumn('category', function ($data) 
                {
                    return $data->category->name;
                })
                ->addColumn('action', function ($data) 
                {   
                    $editButton = '<button data-id="' . $data->id . '" class="btn btn-edit"><i class="fa fa-pencil-alt"></i> </button>';
                    $deleteButton = '<button data-id="' . $data->id . '" class="btn btn-delete"><i class="fa fa-trash"></i> </button>';
                    return $editButton . ' ' . $deleteButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return inertia('DashboardListing', [
            'is_admin' => $user->is_admin,
        ]);
    }

    public function reservations(Request $request)
    {
    $user = auth()->user();

    if ($request->ajax())
    {
        $data = Reservation::with('listing.state', 'listing.location', 'listing.category')
            ->where('userId', $user->id)
            ->get()
            ->pluck('listing');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('id', function ($data) 
            {
                return $data->id;
            })
            ->addColumn('name', function ($data) 
            {
                return $data->title;
            })
            ->addColumn('description', function ($data) 
            {
                return $data->description;
            })
            ->addColumn('roomCount', function ($data) 
            {
                return $data->roomCount;
            })
            ->addColumn('bathroomCount', function ($data) 
            {
                return $data->bathroomCount;
            })
            ->addColumn('guestCount', function ($data) 
            {
                return $data->guestCount;
            })
            ->addColumn('price', function ($data) 
            {
                return $data->price;
            })
            ->addColumn('state', function ($data) 
            {
                return $data->state->name; // Assuming you have a relationship and state model with 'name' attribute
            })
            ->addColumn('location', function ($data) 
            {
                return $data->location->name; // Assuming you have a relationship and location model with 'name' attribute
            })
            ->addColumn('category', function ($data) 
            {
                return $data->category->name; // Assuming you have a relationship and category model with 'name' attribute
            })
            ->make(true);
    }

    return inertia('DashboardReservation', [
        'is_admin' => $user->is_admin,
    ]);
}



}