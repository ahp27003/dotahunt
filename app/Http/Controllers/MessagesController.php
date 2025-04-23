<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        // All threads, ignore deleted/archived participants
        //$threads = Thread::getAllLatest()->get();
        // $participant = Participant::find(8);
        // foreach($threads->users as $user){
        //     dd($user->where('id', 1));


        // }
        //dd($threads->participants);
        //dd($participant->user);

        // All threads that user is participating in
        $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();
        // dd($threads);
        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();

        return view('messenger.index', compact('threads'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::id();

        $check = false;

        foreach ($thread->participants as $participate) {

            if ($participate->user_id == auth()->user()->id) {
                $check = true;
            }
        }

        abort_unless($check, 403);
        $thread->markAsRead($userId);

        $receiver = $thread->participants()->where('user_id', '!=', auth()->user()->id)->firstOrFail();
        $sendTo = $receiver->user;
        //dd($sendTo);
        return view('messenger.show', compact('thread', 'sendTo'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    // public function create($id)
    // {
    //     $users = User::where('id', '!=', Auth::id())->get();

    //     return view('messenger.create', compact('users'));
    // }

    public function create(User $user)
    {
        //dd('s');
        $users = User::where('id', '!=', Auth::id())->get();

        return view('messenger.create2', compact('users', 'user'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    // public function store()
    // {
    //     $input = Request::all();

    //     $thread = Thread::create([
    //         'subject' => $input['subject'],
    //     ]);

    //     // Message
    //     Message::create([
    //         'thread_id' => $thread->id,
    //         'user_id' => Auth::id(),
    //         'body' => $input['message'],
    //     ]);

    //     // Sender
    //     Participant::create([
    //         'thread_id' => $thread->id,
    //         'user_id' => Auth::id(),
    //         'last_read' => new Carbon,
    //     ]);

    //     // Recipients
    //     if (Request::has('recipients')) {
    //         $thread->addParticipant($input['recipients']);
    //     }

    //     return redirect()->route('messages');
    // }

    public function store()
    {
        $input = Request::all();

        $t = $thread = Thread::create([
            'subject' => $input['subject'],
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $input['message'],
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        // Recipients
        if (Request::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }

        if (request()->wantsJson()) {
            return ['message' => "/messages/$t->id"];
        }

        return redirect()->route('messages');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => Request::input('message'),
        ]);

        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Request::has('recipients')) {
            $thread->addParticipant(Request::input('recipients'));
        }

        return redirect()->route('messages.show', $id);
    }
}
