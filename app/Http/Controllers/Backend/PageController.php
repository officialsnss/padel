<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Amenities;
use App\Models\Countries;
use App\Models\Regions;
use App\Models\Cities;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PageController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */

     //Page Listing
    public function index()
    {
        try{
            $title = 'Pages';
            $pages = Page::all();
            return view('backend.pages.page', compact('title','pages'));
        }
        catch (\Exception $e) {
            return redirect('/admin')->with('error', 'Something went wrong.');
        }    
    }

    // Page Create

    public function create()
    { 
        try{
            $title = 'Create Page';
            return view('backend.pages.pageCreate', compact('title'));
        }
        catch (\Exception $e) {
            return redirect('/admin/pages/')->with('error', 'Something went wrong.');
        }
    }

    public function add(Request $request)
    {
        try{
            $request->validate([
             'title' => 'required|string',
             'content' => 'required'
            ]);

            $result = Page::create([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => Str::slug($request->title),
            ]);
        
            if($result){
            return redirect('/admin/pages')->with('success', 'Page Created Successfully.');
            }
        }
        catch (\Exception $e) {
            return redirect('/admin/pages')->with('error', 'Something went wrong.');
        }    
    }

    // Page View
    public function view($id){
        try{
            $title = 'Page View';
            $pageInfo = Page::where('id', $id)->get();
            return view('backend.pages.pageView', compact('title','pageInfo'));
        }
        catch (\Exception $e) {
            return redirect('/admin/pages')->with('error', 'Something went wrong.');
        }
    }

     // Page Edit 

    public function edit($id)
    {
        try{
            $pageData= Page::where('id', $id)->get();
            $title = 'Edit Page';
            return view('backend.pages.pageEdit', compact('title','pageData'));
        }
        catch (\Exception $e) {
            return redirect('/admin/pages')->with('error', 'Something went wrong.');
        }
    }
    public function update(Request $request, $id)
       {
        try{
            $request->validate([
                'title' => 'required|string',
                'content' => 'required'
            ]);
          
           $page = Page::findOrFail($id);
           $page->title = $request->title;
           $page->content = $request->content;
           $page->slug = Str::slug($request->title);
           $page->save(); 
           return redirect('/admin/pages')->with('success', 'Page Updated successfully');
        }
        catch (\Exception $e) {
            return redirect('/admin/pages')->with('error', 'Something went wrong.');
        }
    }

    // Amenities Listing 

    public function amenities()
    {
        try{
            $title = 'Amenities';
            $amenities = Amenities::all();
            return view('backend.pages.amenities', compact('title','amenities'));
        }
        catch (\Exception $e) {
            return redirect('/admin')->with('error', 'Something went wrong.');
        }
    }

     // Amenities Create 
    
    public function amenitiesCreate()
    {
        try{
            $title = 'Create Amenities';
            return view('backend.pages.amenityCreate', compact('title'));
        }
        catch (\Exception $e) {
            return redirect('/admin/amenities')->with('error', 'Something went wrong.');
        }
    }

  

    public function amenitiesAdd(Request $request)
    {
        try{
            $request->validate([
                'desc' => 'required|string',
            ]);

                $result = Amenities::create([
                'name' => $request->desc,
            ]);
      
            if($result){
                return redirect('/admin/amenities')->with('success', 'Amenities Created Successfully.');
            }
        }
        catch (\Exception $e) {
            return redirect('/admin/amenities')->with('error', 'Something went wrong.');
        }
    }
    
     // Amenities Edit
    
    public function amenitiesEdit(Request $request, $id)
    {
        try{
            $amenitityData = Amenities::where('id', $id)->get();
            $title = 'Edit Amenities';
        return view('backend.pages.amenityEdit', compact('title','amenitityData'));
        }
        catch (\Exception $e) {
            return redirect('/admin/amenities')->with('error', 'Something went wrong.');
        }
    }

    public function amenitiesUpdate(Request $request, $id){
        try
        { 
            $request->validate([
                'desc' => 'required|string',
            ]);
          
            $amenity = Amenities::findOrFail($id);
            $amenity->name = $request->desc;
            $amenity->save(); 
            return redirect('/admin/amenities')->with('success', 'Amenity Updated successfully');
        }
        catch (\Exception $e) {
            return redirect('/admin/amenities')->with('error', 'Something went wrong.');
           
        }
    }

     // Region Listing 

     public function regions()
     {
        try{
            $title = 'Regions';
          
            $regions = Regions::leftJoin('countries', 'regions.country_id', '=', 'countries.id')
                      ->select('regions.*','countries.name as cname')
                      ->get();
    
            return view('backend.pages.regions', compact('title','regions'));
         }
         catch (\Exception $e) {
            return redirect('/admin')->with('error', 'Something went wrong.');
        }    
     }

     // Region Create 

     public function regionsCreate()
     {
        try{
            $title = 'Create Region';
            $countries = Countries::all();
           
            return view('backend.pages.regionCreate', compact('title','countries'));
        }
        catch (\Exception $e) {
            return redirect('/admin/regions')->with('error', 'Something went wrong.');
        } 
     }

     public function regionsAdd(Request $request)
    {
        try{
            $request->validate([
                'country_name' => 'required',
                'region' => 'required|string',
            ]);

                $result = Regions::create([
                    'country_id' => $request->country_name,
                    'name' => $request->region,
            ]);

           // dd($request->country_name);
      
            if($result){
                return redirect('/admin/regions')->with('success', 'Region Created Successfully.');
            }
       }
        catch (ValidationException   $e) {
        
           return redirect('/admin/regions')->with('error', 'Something went wrong.');
        }
    }

   // Region Edit 

   public function regionsEdit($id)
   {
    try{
        $regionsData = Regions::where('id', $id)->get();
        $countries = Countries::all();
        $title = 'Edit Region';
        return view('backend.pages.regionEdit', compact('title','regionsData', 'countries'));
    }
    catch (\Exception $e) {
        return redirect('/admin/regions')->with('error', 'Something went wrong.');
    }
   }

   public function regionsUpdate(Request $request, $id){
    try
    { 
        $request->validate([
            'country_name' => 'required',
            'region' => 'required|string',
        ]);
      
        $region = Regions::findOrFail($id);
        $region->country_id = $request->country_name;
        $region->name = $request->region;
        $region->save(); 
        return redirect('/admin/regions')->with('success', 'Region Updated successfully');
    }
    catch (\Exception $e) {
        return redirect('/admin/regions')->with('error', 'Something went wrong.');
       
    }
}

// Cities
  public function cities()
     {
        try{
            $title = 'Cities';
            $cities = Cities::leftJoin('regions', 'cities.region_id', '=', 'regions.id')
                             ->leftJoin('countries', 'regions.country_id', '=', 'countries.id')
                             ->select('cities.*','countries.name as cname','regions.name as regionname')
                             ->get();
    
            return view('backend.pages.cities', compact('title','cities'));
         }
         catch (\Exception $e) {
            return redirect('/admin')->with('error', 'Something went wrong.');
        }    
     }

     // City Create
     public function citiesCreate(){
        try{
            $title = 'Create City';
            $regions = Regions:: leftJoin('countries', 'regions.country_id', '=', 'countries.id')
                        ->select('regions.*','countries.name as cname')
                        ->get();
          
            return view('backend.pages.cityCreate', compact('title','regions'));
        }
        catch (\Exception $e) {
            return redirect('/admin/cities')->with('error', 'Something went wrong.');
        } 
     }

     public function citiesAdd(Request $request){
        try{
            
            $request->validate([
                'region_name' => 'required',
                'city' => 'required|string',
            ]);
            
                $result = Cities::create([
                    'region_id' => $request->region_name,
                    'name' => $request->city,
                  
            ]);
           
            if($result){
                return redirect('/admin/cities')->with('success', 'City Created Successfully.');
            }
       }
        catch (ValidationException  $e) {
        
           return redirect('/admin/cities')->with('error', 'Something went wrong.');
        }
     }

      // City Edit
      public function citiesEdit($id){
        try{
            $cityData = Cities::where('id', $id)->get();
            $regions = Regions:: leftJoin('countries', 'regions.country_id', '=', 'countries.id')
                        ->select('regions.*','countries.name as cname')
                        ->get();
            $title = 'Edit City';
            return view('backend.pages.cityEdit', compact('title','cityData', 'regions'));
        }
        catch (\Exception $e) {
            return redirect('/admin/cities')->with('error', 'Something went wrong.');
        }
     }
     public function citiesUpdate(Request $request, $id){
        try
    { 
        $request->validate([
            'region_name' => 'required',
            'city' => 'required|string',
        ]);
      
        $city = Cities::findOrFail($id);
        $city->region_id = $request->region_name;
        $city->name = $request->city;
        $city->save(); 
        return redirect('/admin/cities')->with('success', 'City Updated successfully');
    }
        catch (\Exception $e) {
            return redirect('/admin/cities')->with('error', 'Something went wrong.');
        
        }
    }

    // City Delete
    public function citiesDelete(Request $request, $id)
    {
        try{
            $res= Cities::where('id',$id)->delete();
           if($res){
              return redirect('/admin/cities')->with('success', 'Deleted Successfully.');
           }
        }
        catch (\Exception $e) {
            return redirect('/admin/cities')->with('error', 'Something went wrong.');
        
         }
        }
}