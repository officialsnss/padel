<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Amenities;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PageController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\View\View
     */
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
   
}