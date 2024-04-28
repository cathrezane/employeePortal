<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaigns;

class CampaignsController extends Controller
{
    //
    public function index()
    {
        $campaigns = Campaigns::paginate(15);

        return view('admin.pages.campaigns', compact('campaigns'));
    }

    public function destroy($id)
    {
        $campaign = Campaigns::find($id);
        $campaign->delete();
        
        return redirect()->back()->with('success', 'Campaign deleted successfully');
    }
}
