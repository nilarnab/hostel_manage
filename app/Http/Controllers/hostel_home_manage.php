<?php

namespace App\Http\Controllers;

use App\HostelerInfo;
use App\Member;
use App\Room;
use App\Food;
use App\Menue;
use App\MessTiming;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class hostel_home_manage extends Controller
{
    //

    public function index()
    {

        // Routing
        // finding if hosteler or admin or mess secretary


        $user_data = Member::with('hosteler_room')->where('id', Auth::id())->get()[0];

        /*
         * role: 1 hosteler
         * role: 2 admin
         *
         */
        if ($user_data['post'] == 1)
        {
            // okay
        }
        elseif ($user_data['post'] == 2)
        {
            redirect('/admin_panel');
        }
        else
        {
            // mess secretary here
        }

//        return $user_data["hosteler_room"]["name"];



        $rooms_status = $this->get_room_data();

        $food_data = $this->mess_engine();

        return view('hostel_home', [
            'user_data'=>$user_data,
            'dish' => $food_data,
            'rooms_status' => $this->process_bars($rooms_status)
        ]);
    }

    function change_room()
    {
        $all_rooms = Room::all();
        $id = 0;
        foreach ($all_rooms as $room)
        {
            $room['id'] = ++$id;
        }

        return view('change_room', ['all_rooms'=> $all_rooms]);
    }


    // HANDLING POST REQUEST
    // ___________________________________________________________________
    function change_profile(Request $request)
    {

        $info = new HostelerInfo();
        $info->room_no = $request->room_no;

        return $request;
    }

    function change_room_handle(Request $request)
    {
        $validated = $request->validate([
            'room' => 'required|max:4|min:4',
        ]);

        $room = Room::where('name', $validated["room"])->get()[0];

        if ($room->status == 1)
        {
            // updating data
            Room::where('name', $room->name)->update(['taken_by'=>Auth::id(), 'status'=>4]);
            return redirect()->back()->with('success', "request registered");
        }
        elseif($room->status == 2)
        {
            return redirect()->back()->with('not_allowed', "it is already taken");
        }
        elseif($room->status == 3)
        {
            return redirect()->back()->with('not_alowed', "damaged room");
        }
        elseif($room->status == 4)
        {
            return redirect()->back()->with('not_allowed', "already requested");
        }
        else
        {
            return redirect()->back()->with('not_allowed', "unanticipated status");
        }

    }

    function mess_engine()
    {
        /*
         * Returns the food for the current time
         *
         * [
         *         []
         *          []
         *          []
         * ]
         *
         */
        $today = Carbon::now();
        $day_today = strtolower(substr($today->format('l'), 0, 3));

        $data = Menue::with('has_food')->where('day', $day_today)->get();


        $dish = [];

        foreach ($data as $row)
        {
            array_push($dish, ['title'=>$row['has_food']['name'], 'describe' => $row['has_food']['description'], 'pic_url' => $row['has_food']['pic_url']]);
        }

        return $dish;



    }


    public function delete_food(Request $request)
    {

        if(count(Menue::where('food_id', $request['food_id'])->get()))
        {
            return redirect()->back()->with('failure_del_food', 'The food is used in menue!');
        }

        Food::where('id', $request['food_id'])->delete();

        return redirect()->back()->with('success_del_food', 'Success in removing food');

    }

    public function delete_timing(Request $request)
    {

        if(count(Menue::where('time', $request['food_id'])->get()))
        {
            return redirect()->back()->with('failure_del_timing', 'The timing is used in menue!');
        }

        Food::where('id', $request['food_id'])->delete();

        return redirect()->back()->with('success_del_timing', 'Success in removing timing');

    }

    private function get_room_data()
    {
        $rooms = Room::all();

        $rooms_data = [
            '1' => [],
            '2' => [],
            '3' => [],
            '4' => []
        ];

        foreach ($rooms as $room)
        {
            array_push($rooms_data[$room['status']], [$room['id'], $room['name']]);
        }

        return $rooms_data;

    }

    private function process_bars($rooms_status)
    {

        $p = count($rooms_status['1']);
        $q = count($rooms_status['2']);
        $r = count($rooms_status['3']);

        $mx = max([$p, $q, $r]);

        $x = 300 / $mx;

        return [
            '1' => [$p * $x, $p],
            '2' => [$q * $x, $q],
            '3' => [$r * $x, $r]
        ];

    }

    /* ADMIN CONTROL */

    private function num_pending($room_info)
    {
        $count = 0;
        foreach ($room_info as $room)
        {
            if ($room['status_id'] == 4)
            {
                $count ++;
            }
        }
        return $count;
    }
    public function admin_panel()
    {

        // get the request table
        $room_info = $this->get_room_info();
        $count = $this->num_pending($room_info);






        // mess timing
        $mess_timings = $this->get_mess_timing();


        // users table with room number
        $users = $this->get_users();

//        return $users;

        // mail management


        return view('admin_view', ['room_info' => $room_info, 'users' => $users, 'mess_timings' => $mess_timings,
            'num_pending_request' => $count, 'rooms_status' => $this->process_bars($this->get_room_data()), 'users_num' => count($users)]);
    }

    public function add_food(Request $request)
    {
//        return $request->all();

        if ($request['meal_name'] == NULL)
        {
            return redirect()->back()->with('failure_food', 'Name is required');
        }

        if ($request['meal_describe'] == NULL)
        {
            return redirect()->back()->with('failure_food', 'A description is required');
        }

        if ($request['meal_pic'] == NULL)
        {
            $request['meal_pic'] = 'https://cdn1.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/eat-circle-orange-1024.png';
        }

        $new_row = new Food();

        $new_row->name = $request->meal_name;
        $new_row->description = $request->meal_describe;
        $new_row->pic_url = $request->meal_pic;

        $new_row->save();

        return redirect()->back()->with('success_food', 'New food added successfully');

    }

    private function get_room_info()
    {
        /*
         *
         * generating data of format
         *
         *
         * fields:
         * 0. room_id
         * 1. room number
         * 2. status
         * 3. user involved
         */

        $rooms_raw = Room::with('has_user', 'room_condition')->get();


        $rooms = [];

        foreach($rooms_raw as $room)
        {
//
            $row = [
                'room_id' => $room['id'],
                'name' => $room['name'],
                'status' => $room['room_condition']['name'],
                'status_id' =>$room['room_condition']['id']
            ];


            if ($room['has_user'] != NULL)
            {

                $row['user_id'] = $room['has_user']['id'];
                $row['user_name'] = $room['has_user']['name'];

            }
            else
            {
                $row['user_id'] = NULL;
                $row['user_name'] = NULL;
            }

            array_push($rooms, $row);


        }

        return $rooms;

    }

    private function get_users()
    {

        /*
         *
         * id
         * name
         * email
         * phone
         * room no
         * status of room
         *
         */
        $data_raw = Member::with('hosteler_room')->get();




        $user_info = [];

        $index = 0;

        foreach ($data_raw as $user)
        {

            $user_room = NULL;

            foreach($user['hosteler_room'] as $room)
            {
                if ($room['status'] == 2)
                {
                    $user_room = $room;
                    break;
                }
            }

            $user['hosteler_room'] = $user_room;



            $row = [
                'sl_no' => ++ $index,
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                $row['room_id'] = NULL,
                $row['room_name'] = NULL
            ];

            if ($user['hosteler_room'] != NULL)
            {
                if ($user['hosteler_room']['status'] == 2)
                {
                    $row['room_id'] = $user['hosteler_room']['id'];
                    $row['room_name'] = $user['hosteler_room']['name'];
                }
            }

            array_push($user_info, $row);
        }

        return $user_info;
    }

    private function get_mess_timing()
    {
        return MessTiming::all();
    }


    /* Mess management */

    public function mess_manage()
    {

//        return $this->get_foods();

//        return $this->get_dishes();

        $mess_timings = $this->get_mess_timing();

        $timing_id_to_timing_name = [];

        foreach ($mess_timings as $mess_timing)
        {
            $timing_id_to_timing_name[$mess_timing['id']] = $mess_timing['meal_name'];
        }



        return view('mess', ['mess_timings'=>$mess_timings, 'menues' => $this->get_dishes(), 'foods' => $this->get_foods(), 'timing_id_to_timing_name' => $timing_id_to_timing_name]);
    }

    private function get_dishes()
    {
        /*
         * Return
         * [
         *      [
         *          for each timing
         *      ]
         * ]
         *
         */


        $timings = MessTiming::all();

        $total_data = [];

        foreach ($timings as $timing)
        {

            $menue = Menue::with('has_food')->where('time', $timing['id'])->get();

            $total_data[$timing['id']] = $menue;

        }
        return $total_data;
    }

    public function update_timing(Request $request)
    {
//        return $request->all();
        // validation
        $validated = $request->validate([
            'meal_name' => 'required',
            'meal_start' => 'required',
            'meal_end' => 'required'
        ]);

        $validated->error()->add('field', 'a new field');



        MessTiming::where('id', $request['meal_chosen'])
            ->update(
                [
                    'meal_name' => $request['meal_name'],
                    'start' => $request['meal_start'],
                    'end' => $request['meal_end']
                ]
            );

        return redirect()->back()->with('success', 'Update complete');

    }

    public function update_menue(Request $request)
    {


        if ($request->has('meal_name', 'day', 'food_id'))
        {


            Menue::where('time', $request['meal_name'])
                ->where('day', $request['day'])
                ->update(
                    [
                        'food_id' => $request['food_id']
                    ]
                );

            return redirect()->back()->with('success_menue', 'Update complete');

        }

        else
        {
            return redirect()->back()->with('failure_menue', 'Some fields were not filled');
        }








    }



    // Ajax requests (get)
    public function approve_hosteler(Request $request)
    {

        // trying to update
        $room_id = $request['id'];

        $room_info = Room::where('id', $room_id)->get()[0];

        if ($room_info['status'] != 4)
        {
            return ['result' => 'invalid request'];
        }

        else
        {
            // valid request
            $user_id = $room_info['taken_by'];

            // find any other room taken by the same user
            $current_room = Room::where('taken_by', $user_id)->where('id', '!=', $room_id)->get();

            if (count($current_room) == 1)
            {
                // removing old room
                $current_room_id = $current_room[0]['id'];
                Room::where('id', $current_room_id)->update(['status'=> 1, 'taken_by' => NULL]);
            }

            // assigning new room
            Room::where('id', $room_id)->update(['status' => 2, 'taken_by'=>$user_id]);

            $num_pending_reqs = $this->num_pending($this->get_room_info());

            return ["result" => 'success', 'pending_now' => $num_pending_reqs];

        }



    }

    public function deny_hosteler(Request $request)
    {

        // trying to update
        $room_id = $request['id'];

        $room_info = Room::where('id', $room_id)->get()[0];

        if ($room_info['status'] != 4)
        {
            return ['result' => 'invalid request'];
        }

        else
        {
            // valid request
            $user_id = $room_info['taken_by'];

            // assigning new room
            Room::where('id', $room_id)->update(['status' => 1, 'taken_by'=>NULL]);

            $num_pending_reqs = $this->num_pending($this->get_room_info());

            return ["result" => 'success', 'pending_now' => $num_pending_reqs];

        }



    }

    public function get_foods()
    {
        return Food::all();
    }

    /* END */


}
