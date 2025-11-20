<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;

class NotificationController extends Controller
{
    public function getLatestNotifications()
    {
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($notif) {
                return [
                    'id' => $notif->id,
                    'title' => $notif->title,
                    'message' => $notif->message,
                    'type' => $notif->type,
                    'is_read' => $notif->is_read,
                    'time_ago' => $notif->created_at->diffForHumans(),
                ];
            });

        $unreadCount = auth()->user()->unreadNotifications()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    public function getUnreadCount()
    {
        $unreadCount = auth()->user()->unreadNotifications()->count();

        return response()->json(['unread_count' => $unreadCount]);
    }
    // public function index()
    // {
    //     $notifications = auth()->user()
    //         ->notifications()
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     return view('notifications.index', compact('notifications'));
    // }

    public function markAsRead($id)
    {
        $notification = UserNotification::where('user_id', auth()->id())->findOrFail($id);
        $notification->update(['is_read' => true]);

        return back();
    }

    public function markAll()
    {
        UserNotification::where('user_id', auth()->id())
            ->update(['is_read' => true]);

        return back();
    }

    public function destroy($id)
    {
        $notification = UserNotification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (! $notification) {
            return response()->json(['error' => true], 404);
        }

        $notification->delete();

        return response()->json(['success' => true]);
    }
}
