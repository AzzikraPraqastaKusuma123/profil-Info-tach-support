<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Client;
use App\Models\Information;
use App\Models\ChatSession;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    // Dashboard overview
    public function index()
    {
        $servicesCount = Service::count();
        $articlesCount = Information::count();
        $activeChatsCount = ChatSession::where('is_active', true)->count();

        // Get recent active chat sessions
        $recentChats = ChatSession::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        // Traffic metrics
        $trafficYear = DB::table('visitor_logs')->where('created_at', '>=', now()->startOfYear())->count();

        return view('admin.dashboard', compact(
            'servicesCount', 'articlesCount', 'activeChatsCount', 'recentChats',
            'trafficYear'
        ));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'service_' . time() . '.' . $file->extension();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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
            $filename = 'service_' . time() . '.' . $file->extension();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'info_' . time() . '.' . $file->extension();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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
            $filename = 'info_' . time() . '.' . $file->extension();
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

    // ==========================================
    // ADMINS MANAGEMENT (USERS)
    // ==========================================
    public function usersIndex()
    {
        $admins = Admin::orderBy('id', 'asc')->get();
        return view('admin.users', compact('admins'));
    }

    public function usersStore(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:admins,username',
            'password' => 'required|string|min:6|max:255',
            'name' => 'required|string|max:255',
        ]);

        Admin::create([
            'username' => strip_tags($request->username),
            'password' => Hash::make($request->password),
            'name' => strip_tags($request->name),
        ]);

        return redirect()->route('admin.users')->with('success', 'Admin baru berhasil ditambahkan.');
    }

    public function usersUpdatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6|max:255',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')->with('success', 'Password admin berhasil diganti.');
    }

    public function usersDestroy($id)
    {
        // Prevent deleting yourself!
        if ($id == session('admin_id')) {
            return redirect()->route('admin.users')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.users')->with('success', 'Akun admin berhasil dihapus.');
    }

    // ==========================================
    // ADMIN PROFILE
    // ==========================================
    public function profileIndex()
    {
        $admin = Admin::findOrFail(session('admin_id'));
        return view('admin.profile', compact('admin'));
    }

    public function profileUpdate(Request $request)
    {
        $adminId = session('admin_id');
        $request->validate([
            'username' => 'required|string|max:255|unique:admins,username,' . $adminId,
            'name' => 'required|string|max:255',
        ]);

        $admin = Admin::findOrFail($adminId);
        $admin->update([
            'username' => strip_tags($request->username),
            'name' => strip_tags($request->name),
        ]);

        // Instantly update active session
        session([
            'admin_name' => $admin->name,
            'admin_username' => $admin->username
        ]);

        return redirect()->route('admin.profile')->with('success', 'Profil Anda berhasil diperbarui.');
    }

    public function profileUpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|max:255|confirmed',
        ]);

        $admin = Admin::findOrFail(session('admin_id'));

        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->route('admin.profile')->with('error', 'Password saat ini salah.');
        }

        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('admin.profile')->with('success', 'Password Anda berhasil diubah.');
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
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'client_' . time() . '.' . $file->extension();
            $file->move(public_path('clients'), $filename);
            $logoPath = '/clients/' . $filename;
        }

        Client::create([
            'name' => strip_tags($request->name),
            'industry' => strip_tags($request->industry),
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.clients')->with('success', 'Mitra klien berhasil ditambahkan.');
    }

    public function clientsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $client = Client::findOrFail($id);
        $logoPath = $client->logo;

        if ($request->hasFile('logo')) {
            // Delete old logo file if it exists and starts with /clients/client_
            if (!empty($client->logo) && File::exists(public_path($client->logo))) {
                if (str_contains($client->logo, 'client_')) {
                    File::delete(public_path($client->logo));
                }
            }

            $file = $request->file('logo');
            $filename = 'client_' . time() . '.' . $file->extension();
            $file->move(public_path('clients'), $filename);
            $logoPath = '/clients/' . $filename;
        }

        $client->update([
            'name' => strip_tags($request->name),
            'industry' => strip_tags($request->industry),
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.clients')->with('success', 'Mitra klien berhasil diperbarui.');
    }

    public function clientsDestroy($id)
    {
        $client = Client::findOrFail($id);

        // Delete logo file if it exists and starts with /clients/client_
        if (!empty($client->logo) && File::exists(public_path($client->logo))) {
            if (str_contains($client->logo, 'client_')) {
                File::delete(public_path($client->logo));
            }
        }

        $client->delete();

        return redirect()->route('admin.clients')->with('success', 'Mitra klien berhasil dihapus.');
    }
}
