<?php

namespace App\Http\Controllers;
use Illuminate\Routing\ResponseFactory;
//use App\Abstracts\eventsTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;

class EventsapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	
	 //use EventTransformer;
	/* protected $eventTransformer;
	 
	 public function __construct(EventTransformer $EventTransformer){

		$this->$eventTransformer = $EventTransformer; // replace 'collector' with whatever role you need.
	}
*/

    public function index()
    {
        //
		$events =  Event::All();
		$response = array();
	
		return response()->json([
		
		'data'=>$this->transform($events)
		
		],200);
		
		//return $response['data']=$events;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$event = Event::find($id);
		
		if(!$event)
		{
			return response()->json([
		
				'error'=> 'Event does not exist',
				'code' => 'e101'
				],404);
		}
		
			return response()->json([
			
				'data'=>$event->toArray()
			
			],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	public function transform($events)
	{
		
			return array_map(function($event){	
				
			return [
						'event'=> $event['event'],
						'date' => $event['date'],
						'e_code'=> $event['eventcode'],
						'country'=> $event['country'],
						'city'=> $event['city']
				];
				
			},$events->toArray());
		
	}
	
	
}
