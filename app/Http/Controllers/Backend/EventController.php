<?php

namespace App\Http\Controllers\Backend;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Mail\NewEventMail;
use App\Models\Image;
use App\Models\User;
use App\Notifications\LogNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'place' => 'required|string',
            'image' => 'required|file|image',
            'time' => 'required|date_format:H:i',
            'event_date' => 'required|date',
            'images.*' => 'file|image|mimes:jpg,jpeg,png,bmp|max:2000',
            'video' => 'url'
        ]);
        $data = [
            "title" => $request->title,
            "description" => $request->description,
            "place" => $request->place,
            "time" => $request->time,
            "video"=>$request->video,
            "event_date" => $request->event_date,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk("local")->put("uploads\\events\\images", $request->image);
        }
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = [
                    'image' => Storage::disk("local")->put("uploads\\events\\images", $image)
                ];
            }
        }
        // dd($images);
        $event = new Event($data);

        if ($event->save()) {
            //dd($event);
            $volunteers = User::role('volunteer')->where('id', '!=', auth()->id())->get();
            foreach ($images as $value) {
                $event->imageble()->create($value);
            }

            foreach ($volunteers as $volunteer) {
                $volunteer->notify(new LogNotification('New Event has been created by ' . auth()->user()->name));
                 Mail::to($volunteer->email)->send(new NewEventMail);
            }
            return back()->with('success', 'Event created successfully!');
        }
        return back()->with('error', 'Something went wrong!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($event)
    {
        $eventInfo = Event::with('imageble')->findOrFail($event);
        return view('backend.events.show', [
            'event' => $eventInfo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('backend.events.edit', [
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'place' => 'required|string',
            'image' => 'nullable|file|image',
            'time' => 'required|date_format:H:i',
            'event_date' => 'required|date',
        ]);
        $data = [
            "title" => $request->title,
            "description" => $request->description,
            "place" => $request->place,
            "time" => $request->time,
            "event_date" => $request->event_date,
        ];

        if ($request->hasFile('image')) {
            if (Storage::disk("local")->exists($event->image)) {
                Storage::disk("local")->delete($event->image);
            }
            $data['image'] = Storage::disk("local")->put("uploads\\events\\images", $request->image);
        }

        $event->fill($data);
        if ($event->save()) {
            return back()->with('success', 'Event updated successfully!');
        }
        return back()->with('error', 'Something went wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($event)
    {
        $eventInfo = Event::with('imageble')->findOrFail($event);

        if (Storage::disk("local")->exists($eventInfo->image)) {
            Storage::disk("local")->delete($eventInfo->image);
        }
        if ($eventInfo->imageble && count($eventInfo->imageble) > 0) {

            foreach ($eventInfo->imageble as $key => $value) {
                if (Storage::disk("local")->exists($value->image)) {
                    Storage::disk("local")->delete($value->image);
                }
            }
        }

        if ($eventInfo->delete()) {
            Image::where('imageable_id', $eventInfo->id)->delete();
            return back()->with('success', 'Event deleted successfully!');
        }
        return back()->with('error', 'Something went wrong!');
    }
}
