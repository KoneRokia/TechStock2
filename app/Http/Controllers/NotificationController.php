<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\License;
use App\Notifications\LicenceRenewalNotification;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications; // Récupère toutes les notifications

        // Marquer les notifications comme lues
        auth()->user()->unreadNotifications->markAsRead();

        return view('notifications.index', compact('notifications'));

        // Trouve l'admin (supposons que l'admin est le premier utilisateur)
$admin = User::where('role', 'admin')->first();

// Trouve la licence concernée
$license = License::find($licenseId);

// Envoi de la notification
$admin->notify(new LicenceRenewalNotification($license));

    }


    public function showNotifications()
    {
        $notifications = auth()->user()->notifications; // Récupère toutes les notifications de l'utilisateur
        return view('notifications.index', compact('notifications'));
    }


        
            public function markAsRead($id)
        {
            $notification = auth()->user()->notifications()->findOrFail($id);
            $notification->markAsRead();

            return redirect()->back()->with('success', 'Notification marquée comme lue.');
        }



}
