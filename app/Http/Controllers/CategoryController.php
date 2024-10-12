<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ConversationCollection;


class CategoryController extends Controller
{
    /**
     * Get the categories from the db
     */
    public function index(Request $request) 
    {
        return new CategoryCollection(Category::where('author_id', Auth::id())->orderBy('created_at', 'desc')->get());
    }

    /**
     * Get a category from the db
     */
    public function show(Request $request) 
    {
        $catId = intval(request('id'));

        $category = new CategoryResource(Category::where('id', $catId)->first());
        $conversations = new ConversationCollection(Conversation::where('author_id', Auth::id())->whereJsonContains('categories', $catId)->get());

        return response()->json(['conversations' => $conversations, 'category' => $category]) ;
    }
    
    /**
     * Store the category in the db
     */
    public function store(CategoryStoreRequest $request)
    {

        $categoryData = $request->validated();
        
        $category = new Category();
        $category->name = $categoryData['name'];
        $category->color = $categoryData['color'];
        $category->parent_id = $categoryData['parent_id'];
        $category->author_id = Auth::id();
        $category->save();

        return response()->json(['message' => 'Category saved', 'id' => $category->id]);
    }

    /**
     * Update a category
     */
    public function update(CategoryStoreRequest $request) 
    {
        $catId = request('id');

        $categoryData = $request->validated();
        
        $category = Category::where('id', $catId)
            ->update([
                'name' => $categoryData['name'],
                'color' => $categoryData['color'],
                'parent_id' => $categoryData['parent_id']
            ]);

        return response()->json(['message' => 'Category updated', 'id' => $category]) ;
    }

    /**
     * Delete a category
     */
    public function delete(Request $request) 
    {
        $catId = request('id');
        
        $category = Category::where('id', $catId)->delete();

        return response()->json(['message' => 'Category deleted', 'id' => $category]) ;
    }
}
