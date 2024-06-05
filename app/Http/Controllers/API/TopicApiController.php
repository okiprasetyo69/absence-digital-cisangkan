<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use App\Absence;
use App\Topic;
use App\Http\Controllers\Api\QueryFilters\AbsenceQueryFilter;
use App\Http\Controllers\Api\QueryFilters\TopicQueryFilter;
use Illuminate\Support\Facades\Validator;
class TopicApiController extends BaseApiController
{

    public function getListDataTopic(Request $request){
        $topicQueryFilter = new TopicQueryFilter($request->all());
        $topicQuery = Topic::orderBy('event_date', 'DESC');
       
        if ($topicQueryFilter->get_search_text() != null) {
            $topicQuery = $topicQuery->where("topic_name", "like", "%" . $topicQueryFilter->get_search_text() . "%");
        }

        if($request->event_date != ""){
            $topicQuery = $topicQuery->where('event_date', $request->event_date);
        }
        
        $count = (clone $topicQuery)->count();
        $result = $topicQuery->limit($topicQueryFilter->get_length())->offset($topicQueryFilter->get_start());
        $data_get = $result->get();
        $data = $this->set_datatable_response($topicQueryFilter->get_draw(), $count, $result->get());
        return $this->success_response_datatable();
    }

    public function createOrUpdate(Request $request)
    {
          
        $rule = [
            'topic_name' => 'required',
            'event_date' => 'required',
            'location' => 'required',
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->fails()){
            return response($validator->messages()->toArray(), 400);
        }

        $data = [
            'topic_name' => $request->topic_name,
            'event_date' => $request->event_date,
            'location' => $request->location,
        ];

        if($request->id == ""){
            $topic = new Topic($data);
            $topic->save();
        } else {
            $update_topic = Topic::where('id', $request->id);
            $update_topic = $update_topic->update($data);
        }

        return response()->json([
            'message' => 'Successfully created or update topics !'
        ], 201);

    }

    public function delete($id){
        $topic =  Topic::find($id);
        if (!$topic) {
            $data = [
                "message" => "id not found",
            ];
        } else {
            $topic->delete();
            $data = [
                "message" => "success_deleted"
            ];
        }
        return response()->json($data, 200);
    }

    public function detail($id, Request $request){
        $query = Topic::where("id", $id);
        $data_get = $query->first();
        return $data_get;
    }

    public function getCurrentTopic(Request $request){
        $current_date = date("Y-m-d");
        $query = Topic::where("event_date", $current_date);
        $data_get = $query->first();
        return $data_get;
    }

    public function getFilterDateTopic(Request $request){
        $event_date = date('Y-m-d', strtotime($request->event_date));
        $query = Topic::where("event_date", $event_date);
        $data_get = $query->first();
        return $data_get;
    }

    public function getTopicSelect2(Request $request){
        $list_topic = Topic::where("topic_name", "like", "%" . $request->input('searchTerm') . "%")
        ->orderBy('topic_name', 'ASC')
        ->get(['id', 'topic_name as text', 'topic_name']);
        return response()->json($list_topic, 200);
    }
}
