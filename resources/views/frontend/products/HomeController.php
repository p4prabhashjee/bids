<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Purchage;
use App\Models\Page;
use App\Models\Subscribe;
use App\Models\SuggestionCategory;
use App\Models\Suggestion;
use App\Models\PerchageDetail;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use App\Models\Category;
use App\Models\Faq;
use App\Models\ChatHistory;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function search(Request $request)
    {
        try {
            $user = auth()->guard('api')->user();

            $file = Media::where('status', 1)->where('file_type', $user->show_file)->where('title', 'LIKE', '%' . $request['name'] . '%')->orderBy('id', 'DESC')->get();



            return response()->json([
                'status' => 1,
                'data' => $file,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['message' => 'Something went wrong.', 'status' => 500, 'data' => ''], 200);
            exit;
        }
    }

    public function faq(Request $request)
    {
        try {
            $user = auth()->guard('api')->user();

            $file = Faq::where('status', 1)->orderBy('id', 'DESC')->get();



            return response()->json([
                'status' => 1,
                'data' => $file,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['message' => 'Something went wrong.', 'status' => 500, 'data' => ''], 200);
            exit;
        }
    }



    public function category(Request $request)
    {

        try {
            $user = auth()->guard('api')->user();
            $data = Category::where('status', 1)->get();
            $success_msg = 'Data fecch successfully.';
            return response()->json([
                'message' => $success_msg,
                'status' => 204,
                'data'  => $data,
            ], 200);
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['message' => 'Something went wrong.', 'status' => 500, 'data' => ''], 200);
            exit;
        }
    }

    public function discover_detail(Request $request)
    {
        try {
            $data = Category::find($request['discover_id']);
            $success_msg = 'Data fecch successfully.';
            return response()->json([
                'message' => $success_msg,
                'status' => 204,
                'data'  => $data,
            ], 200);
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['message' => 'Something went wrong.', 'status' => 500, 'data' => ''], 200);
            exit;
        }
    }

    public function chat_gpt(Request $request)
    {
        try {
            $user = auth()->guard('api')->user();

            if ($request['category'] == 'Translation') {
                $response = $this->translate($request);
            } elseif ($request['category'] == 'Password Generator') {
                $response = $this->generate_password($request);
            } elseif ($request['category'] == 'Grammar') {
                $response = $this->grammar($request);
            }

            // $search = $request['question'];

            // $data = Http::withHeaders([
            //     'Content-Type' => 'application/json',
            //     'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            // ])
            //     ->timeout(60)
            //     ->post("https://api.openai.com/v1/chat/completions", [
            //         "model" => "gpt-3.5-turbo",
            //         'messages' => [
            //             [
            //                 "role" => "system",
            //                 "content" => $search
            //             ]
            //         ],
            //         'temperature' => 0.5,
            //         "top_p" => 1.0,
            //         "frequency_penalty" => 0.52,
            //         "presence_penalty" => 0.5,
            //         // "stop" => ["11."],
            //     ])
            //     ->json();

            $history = new ChatHistory;
            $history->user_id = $user->id;
            $history->question = $request['question'];
            $history->answer = $response;
            $history->cat_id = $request['discover_id'];
            $history->save();

            $currentDateTime = Carbon::now();
            $currentFormattedTime = $currentDateTime->format('h:i A');

            $success_msg = 'Data Fetach Successfully.';
            return response()->json([
                'message' => $success_msg,
                'time' => $currentFormattedTime,
                'status' => 200,
                'data'  => $response,
            ], 200);
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['message' => 'Something went wrong.', 'status' => 500, 'data' => ''], 200);
            exit;
        }
    }

    public function translate(Request $request)
    {
        $search = $request['question'];

        $lang = $request['language'];

        $data = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])
            ->timeout(60)
            ->post("https://api.openai.com/v1/chat/completions", [
                "model" => "gpt-3.5-turbo",
                'messages' => [
                    [
                        "role" => "system",
                        "content" => "You will be provided with a sentence in English, and your task is to translate it into " . $lang
                    ],
                    [
                        "role" => "user",
                        "content" => $search
                    ]
                ],
                'temperature' => 0,
                "top_p" => 1.0,
                "frequency_penalty" => 0,
                "presence_penalty" => 0
                // "stop" => ["11."],
            ])
            ->json();

        return $data['choices'][0]['message']['content'];
    }

    public function generate_password(Request $request)
    {
        $search = $request['question'];

        $data = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])
            ->timeout(60)
            ->post("https://api.openai.com/v1/chat/completions", [
                "model" => "gpt-3.5-turbo",
                'messages' => [
                    [
                        "role" => "system",
                        "content" => "You are a helpful assistant .",
                    ],
                    [
                        "role" => "user",
                        "content" => 'Generate a secure password for ' . $search
                    ]
                ],
                'temperature' => 0,
                "top_p" => 1.0,
                "frequency_penalty" => 0,
                "presence_penalty" => 0
            ])
            ->json();

        return $data['choices'][0]['message']['content'];
    }

    public function grammar(Request $request)
    {
        $search = $request['question'];

        $data = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])
            ->timeout(60)
            ->post("https://api.openai.com/v1/chat/completions", [
                "model" => "gpt-3.5-turbo",
                'messages' => [
                    [
                        "role" => "system",
                        "content" => "You will be provided with statements, and your task is to convert them to standard English.",
                    ],
                    [
                        "role" => "user",
                        "content" => $search
                    ]
                ],
                'temperature' => 0,
                "top_p" => 1.0,
                "frequency_penalty" => 0,
                "presence_penalty" => 0
            ])
            ->json();

        return $data['choices'][0]['message']['content'];
    }


    public function chat_history(Request $request)
    {
        try {
            $user = auth()->guard('api')->user();
            $data = ChatHistory::where('user_id', $user->id)->get();
            $success_msg = 'Data fecch successfully.';
            return response()->json([
                'message' => $success_msg,
                'status' => 200,
                'data'  => $data,
            ], 200);
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['message' => 'Something went wrong.', 'status' => 500, 'data' => ''], 200);
            exit;
        }
    }

    public function privacy_policy(Request $request)
    {
        $data = Page::find(2);
        try {
            if (!empty($data)) {
                $success_msg = 'Data Fetach Successfully.';
                return response()->json([
                    'message' => $success_msg,
                    'status' => 200,
                    'data'  => $data,
                ], 200);
            } else {
                $error_msg = 'Data Not Found.';
                return response()->json([
                    'message' => $error_msg,
                    'status' => 204,
                    'data'  => '',
                ], 200);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['message' => 'Something went wrong.', 'status' => 500, 'data' => ''], 200);
            exit;
        }
    }

    public function terms_conditions(Request $request)
    {
        $data = Page::find(1);
        try {
            if (!empty($data)) {
                $success_msg = 'Data Fetach Successfully.';
                return response()->json([
                    'message' => $success_msg,
                    'status' => 200,
                    'data'  => $data,
                ], 200);
            } else {
                $error_msg = 'Data Not Found.';
                return response()->json([
                    'message' => $error_msg,
                    'status' => 204,
                    'data'  => '',
                ], 200);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['message' => 'Something went wrong.', 'status' => 500, 'data' => ''], 200);
            exit;
        }
    }

    public function suggestion_category(Request $request)
    {
        try {
            $data = SuggestionCategory::where('status', 1)->get();
            if (!empty($data)) {
                $success_msg = 'Data Fetach Successfully.';
                return response()->json([
                    'message' => $success_msg,
                    'status' => 200,
                    'data'  => $data,
                ], 200);
            } else {
                $error_msg = 'Data Not Found.';
                return response()->json([
                    'message' => $error_msg,
                    'status' => 204,
                    'data'  => '',
                ], 200);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['message' => 'Something went wrong.', 'status' => 500, 'data' => ''], 200);
            exit;
        }
    }

    public function suggestion(Request $request)
    {
        try {
            $data_array = SuggestionCategory::find($request['category']);
            $array = explode(', ', $data_array->suggestion);
            $data = Suggestion::whereIn('id', $array)->get();

            if (!empty($data)) {
                $success_msg = 'Data Fetach Successfully.';
                return response()->json([
                    'message' => $success_msg,
                    'status' => 200,
                    'data'  => $data,
                ], 200);
            } else {
                $error_msg = 'Data Not Found.';
                return response()->json([
                    'message' => $error_msg,
                    'status' => 204,
                    'data'  => '',
                ], 200);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['message' => 'Something went wrong.', 'status' => 500, 'data' => ''], 200);
            exit;
        }
    }
}
