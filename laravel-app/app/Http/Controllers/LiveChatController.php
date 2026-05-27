<?php

namespace App\Http\Controllers;

use App\Models\ChatSession;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class LiveChatController extends Controller
{
    // ==========================================
    // ADMIN ACTIONS (requires admin session)
    // ==========================================

    public function chatDashboard()
    {
        return view('admin.chat');
    }

    public function listSessions()
    {
        $this->checkAutoCloseSessions();
        $sessions = ChatSession::orderBy('updated_at', 'desc')->get();
        return response()->json($sessions);
    }

    public function getSessionMessages($sessionId)
    {
        $this->checkAutoCloseSessions();
        $session = ChatSession::findOrFail($sessionId);
        $messages = $session->messages()->orderBy('created_at', 'asc')->get();
        return response()->json([
            'session' => $session,
            'messages' => $messages
        ]);
    }

    public function sendAdminMessage(Request $request, $sessionId)
    {
        $this->checkAutoCloseSessions();
        $request->validate([
            'message' => 'required|string|max:10000', // Admin can send longer HTML-formatted messages
        ]);

        $session = ChatSession::findOrFail($sessionId);
        
        $msg = ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender'          => 'admin',
            'message'         => $request->message  // Admin messages: no strip_tags (admins are trusted)
        ]);

        // Touch the session to update updated_at timestamp
        $session->touch();

        return response()->json($msg);
    }

    public function toggleTakeover(Request $request, $sessionId)
    {
        $this->checkAutoCloseSessions();
        $session = ChatSession::findOrFail($sessionId);
        $session->is_active = $request->input('is_active', !$session->is_active);
        $session->save();

        // Add a system notice message in the log
        $statusText = $session->is_active ? 'Live Chat diambil alih oleh Admin.' : 'Live Chat diakhiri oleh Admin.';
        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender' => 'bot',
            'message' => $statusText
        ]);

        return response()->json($session);
    }

    // ==========================================
    // VISITOR/USER ACTIONS (public routes)
    // ==========================================

    public function requestTakeover(Request $request)
    {
        $this->checkAutoCloseSessions();
        $request->validate([
            'session_key'   => 'required|string|max:200',
            'user_name'     => 'nullable|string|max:150',
            'auto_transfer' => 'nullable|boolean',
        ]);

        // SECURITY: Strip any HTML tags from visitor-provided user name
        $sanitizedUserName = strip_tags($request->user_name ?? '');
        if (empty($sanitizedUserName)) {
            $sanitizedUserName = 'Pengunjung #' . substr($request->session_key, 0, 5);
        }

        $session = ChatSession::firstOrCreate(
            ['session_key' => $request->session_key],
            ['user_name'   => $sanitizedUserName]
        );

        $session->is_active = true;
        $session->save();

        $autoTransfer = $request->input('auto_transfer', false);
        $promptMessage = $autoTransfer 
            ? '[Dialihkan otomatis ke Live Chat - Bot tidak memahami pertanyaan]' 
            : '[Meminta bantuan Live Chat Admin]';

        // Insert prompt message
        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender'          => 'user',
            'message'         => $promptMessage
        ]);

        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender'          => 'bot',
            'message'         => 'Menghubungkan ke Tim Support... Mohon tunggu sebentar, Admin akan segera membalas pesan Anda.'
        ]);

        return response()->json([
            'success' => true,
            'session' => $session
        ]);
    }

    public function getUserMessages(Request $request)
    {
        $this->checkAutoCloseSessions();
        $request->validate([
            'session_key' => 'required|string',
        ]);

        $session = ChatSession::where('session_key', $request->session_key)->first();

        if (!$session) {
            return response()->json([
                'is_active' => false,
                'messages' => []
            ]);
        }

        $messages = $session->messages()->orderBy('created_at', 'asc')->get();

        return response()->json([
            'is_active' => (bool) $session->is_active,
            'messages' => $messages
        ]);
    }

    public function sendUserMessage(Request $request)
    {
        $this->checkAutoCloseSessions();
        $request->validate([
            'session_key' => 'required|string|max:200',
            'message'     => 'required|string|max:5000',
        ]);

        $session = ChatSession::where('session_key', $request->session_key)->first();

        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        // SECURITY: Strip HTML tags from visitor messages to prevent Stored XSS
        $sanitizedMessage = strip_tags($request->message);
        if (empty(trim($sanitizedMessage))) {
            return response()->json(['error' => 'Message cannot be empty after sanitization'], 422);
        }

        $msg = ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender'          => 'user',
            'message'         => $sanitizedMessage
        ]);

        $session->touch();

        return response()->json($msg);
    }

    public function getPendingCount()
    {
        $this->checkAutoCloseSessions();

        // Count active sessions where the last message is from user
        $sessions = ChatSession::where('is_active', true)->get();
        $count = 0;

        foreach ($sessions as $session) {
            $lastMessage = $session->messages()->orderBy('created_at', 'desc')->first();
            if ($lastMessage && $lastMessage->sender === 'user') {
                $count++;
            }
        }

        return response()->json(['count' => $count]);
    }

    private function checkAutoCloseSessions()
    {
        $cutoff = now()->subHours(12);

        $expiredSessions = ChatSession::where('is_active', true)
            ->where('updated_at', '<', $cutoff)
            ->get();

        foreach ($expiredSessions as $session) {
            $session->is_active = false;
            $session->save();

            // Insert system notice message log
            ChatMessage::create([
                'chat_session_id' => $session->id,
                'sender' => 'bot',
                'message' => '[Sesi ditutup otomatis setelah 12 jam - Dialihkan ke Bot Chat]'
            ]);
        }
    }
}
