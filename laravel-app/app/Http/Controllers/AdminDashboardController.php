<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Client;
use App\Models\Information;
use App\Models\ChatSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminDashboardController extends Controller
{
    // Dashboard overview
    public function index()
    {
        $servicesCount = Service::count();
        $clientsCount = Client::count();
        $articlesCount = Information::count();
        $activeChatsCount = ChatSession::where('is_active', true)->count();

        // Get recent active chat sessions
        $recentChats = ChatSession::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('servicesCount', 'clientsCount', 'articlesCount', 'activeChatsCount', 'recentChats'));
    }

    // ==========================================
    // SERVICES CRUD
    // ==========================================
    public function servicesIndex()
    {
        $services = Service::all();
        return view('admin.services', compact('services'));
    }

    public function servicesStore(Request $request)
    {
        $request->validate([
            'icon' => 'required|string',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'desc' => 'required|string',
            'features' => 'required|array',
            'features.*' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'service_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('services'), $filename);
            $imagePath = '/services/' . $filename;
        }

        Service::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'category' => $request->category,
            'desc' => $request->desc,
            'features' => $request->features,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function servicesUpdate(Request $request, $id)
    {
        $request->validate([
            'icon' => 'required|string',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'desc' => 'required|string',
            'features' => 'required|array',
            'features.*' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $service = Service::findOrFail($id);
        $imagePath = $service->image;

        if ($request->hasFile('image')) {
            if (!empty($service->image) && File::exists(public_path($service->image))) {
                if (str_contains($service->image, 'service_')) {
                    File::delete(public_path($service->image));
                }
            }

            $file = $request->file('image');
            $filename = 'service_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('services'), $filename);
            $imagePath = '/services/' . $filename;
        }

        $service->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'category' => $request->category,
            'desc' => $request->desc,
            'features' => $request->features,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diupdate.');
    }

    public function servicesDestroy($id)
    {
        $service = Service::findOrFail($id);

        if (!empty($service->image) && File::exists(public_path($service->image))) {
            if (str_contains($service->image, 'service_')) {
                File::delete(public_path($service->image));
            }
        }

        $service->delete();

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil dihapus.');
    }

    // ==========================================
    // CLIENTS CRUD
    // ==========================================
    public function clientsIndex()
    {
        $clients = Client::all();
        return view('admin.clients', compact('clients'));
    }

    public function clientsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $logoPath = '';
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'client_' . time() . '.' . $file->getClientOriginalExtension();
            // Store directly in public/clients/ directory
            $file->move(public_path('clients'), $filename);
            $logoPath = '/clients/' . $filename;
        }

        Client::create([
            'name' => $request->name,
            'industry' => $request->industry,
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.clients')->with('success', 'Klien berhasil ditambahkan.');
    }

    public function clientsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $client = Client::findOrFail($id);
        $logoPath = $client->logo;

        if ($request->hasFile('logo')) {
            // Delete old file if it exists and is an uploaded file
            if (!empty($client->logo) && File::exists(public_path($client->logo))) {
                // Keep the default sample logos, only delete dynamic client logos
                if (str_contains($client->logo, 'client_')) {
                    File::delete(public_path($client->logo));
                }
            }

            $file = $request->file('logo');
            $filename = 'client_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('clients'), $filename);
            $logoPath = '/clients/' . $filename;
        }

        $client->update([
            'name' => $request->name,
            'industry' => $request->industry,
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.clients')->with('success', 'Klien berhasil diupdate.');
    }

    public function clientsDestroy($id)
    {
        $client = Client::findOrFail($id);

        if (!empty($client->logo) && File::exists(public_path($client->logo))) {
            if (str_contains($client->logo, 'client_')) {
                File::delete(public_path($client->logo));
            }
        }

        $client->delete();
        return redirect()->route('admin.clients')->with('success', 'Klien berhasil dihapus.');
    }

    // ==========================================
    // INFORMATION CRUD
    // ==========================================
    public function infoIndex()
    {
        $articles = Information::all();
        return view('admin.information', compact('articles'));
    }

    public function infoStore(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'read_time' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'info_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('information'), $filename);
            $imagePath = '/information/' . $filename;
        }

        Information::create([
            'category' => $request->category,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'date' => now()->translatedFormat('d M Y'), // Format to matches current Date style
            'author' => session('admin_name') ?? 'Admin',
            'read_time' => $request->read_time,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.information')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function infoUpdate(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'read_time' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $article = Information::findOrFail($id);
        $imagePath = $article->image;

        if ($request->hasFile('image')) {
            if (!empty($article->image) && File::exists(public_path($article->image))) {
                if (str_contains($article->image, 'info_')) {
                    File::delete(public_path($article->image));
                }
            }

            $file = $request->file('image');
            $filename = 'info_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('information'), $filename);
            $imagePath = '/information/' . $filename;
        }

        $article->update([
            'category' => $request->category,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'read_time' => $request->read_time,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.information')->with('success', 'Artikel berhasil diupdate.');
    }

    public function infoDestroy($id)
    {
        $article = Information::findOrFail($id);

        if (!empty($article->image) && File::exists(public_path($article->image))) {
            if (str_contains($article->image, 'info_')) {
                File::delete(public_path($article->image));
            }
        }

        $article->delete();

        return redirect()->route('admin.information')->with('success', 'Artikel berhasil dihapus.');
    }
}
