<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return inertia('AdminDashboardListing');
    }

    public function data()
    {
        $listings = Listing::with(['state', 'location', 'category'])
        ->where('is_deleted', false)
        ->select([
            'id', 
            'title', 
            'description', 
            'roomCount', 
            'bathroomCount', 
            'guestCount', 
            'price', 
            'stateId', 
            'locationId', 
            'categoryId'
        ]);


        return DataTables::of($listings)
            ->addColumn('state', function ($data) {
                return $data->state ? $data->state->name : 'N/A';
            })
            ->addColumn('location', function ($data) {
                return $data->location ? $data->location->name : 'N/A';
            })
            ->addColumn('category', function ($data) {
                return $data->category ? $data->category->name : 'N/A';
            })
            ->addColumn('roomCount', function ($data) {
                return $data->roomCount;
            })
            ->addColumn('bathroomCount', function ($data) {
                return $data->bathroomCount;
            })
            ->addColumn('guestCount', function ($data) {
                return $data->guestCount;
            })
            ->addColumn('price', function ($data) {
                return $data->price;
            })
            ->addColumn('action', function ($data) {
                $editButton = '<button data-id="' . $data->id . '" class="btn btn-edit"><i class="fas fa-edit"></i></button>';
                $deleteButton = '<button data-id="' . $data->id . '" class="btn btn-delete"><i class="fas fa-trash"></i></button>';
                return $editButton . ' ' . $deleteButton;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
