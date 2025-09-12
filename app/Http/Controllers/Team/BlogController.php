<?php
namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    protected function team()
    {
        return auth()->guard('team')->user();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(! $this->team()->hasPermission('blog.view'), 403);

        $blogs = Blog::with('category')->orderBy('created_at', 'desc')->paginate(10);
        return view('team.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(! $this->team()->hasPermission('blog.create'), 403);

        $categories = BlogCategory::active()->get();
        return view('team.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(! $this->team()->hasPermission('blog.create'), 403);

        $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string|max:255',
            'content'          => 'required|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,bmp,svg|max:5120',
            'status'           => 'nullable|boolean',
        ]);

        $data = $request->only([
            'blog_category_id',
            'title',
            'subtitle',
            'content',
        ]);
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $imagePath     = $request->file('image')->store('blogs', 'public');
            $data['image'] = $imagePath;
        }

        Blog::create($data);

        return redirect()->route('team.blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        abort_if(! $this->team()->hasPermission('blog.view'), 403);

        $blog->load('category');
        return view('team.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        abort_if(! $this->team()->hasPermission('blog.edit'), 403);

        $categories = BlogCategory::active()->get();
        return view('team.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        abort_if(! $this->team()->hasPermission('blog.edit'), 403);

        $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title'            => 'required|string|max:255',
            'subtitle'         => 'nullable|string|max:255',
            'content'          => 'required|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,bmp,svg|max:5120',
            'status'           => 'nullable|boolean',
        ]);

        $data = $request->except(['image']);
        $data = array_merge($data, [
            'blog_category_id' => $request->input('blog_category_id'),
            'title'            => $request->input('title'),
            'subtitle'         => $request->input('subtitle'),
            'content'          => $request->input('content'),
            'status'           => $request->has('status'),
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $imagePath     = $request->file('image')->store('blogs', 'public');
            $data['image'] = $imagePath;
        }

        $blog->update($data);

        return redirect()->route('team.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        abort_if(! $this->team()->hasPermission('blog.delete'), 403);

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('team.blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}
