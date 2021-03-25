<?php







namespace App\Http\Controllers\Api;







use App\Http\Controllers\Controller;



use Illuminate\Http\Request;



use Illuminate\Support\Facades\Auth;



use Illuminate\Support\Facades\Storage;



use Constants;



use App\news;



use App\account;



use DB;







class SearchServiceController extends Controller



{



    /**



     * Display a listing of the resource.



     *



     * @return \Illuminate\Http\Response



     */



    public function index(Request $request)



    {



        $lst = $_GET;



        // $userId = auth('api')->user()->id;



        // if (!$userId) {


        //     return  response()->json([



        //         'status' => false,



        //         'code' => 401,



        //         'message' => trans('message.unauthenticate')



        //   ], 401);



        // }



        $offset = Constants::OFFSET;



        $limit = Constants::LIMIT;



        // if (array_key_exists('offset', $lst) && $lst['offset'] != null) {



        //     $offset = $lst['offset'];



        // }



        // if (array_key_exists('limit', $lst) && $lst['limit'] !=  null) {



        //     $limit = $lst['limit'];



        // }


        $result = news::query();
 
        if(count($lst) == 5)
        {
             
            if (array_key_exists('news_title', $lst) && $lst['news_title'] != null && array_key_exists('provincials', $lst) && $lst['provincials'] != null && array_key_exists('news_type', $lst) && $lst['news_type'] != null && array_key_exists('min', $lst) && $lst['min'] != null && array_key_exists('max', $lst) && $lst['max'] != null) {
                
                if($lst['provincials']  == 4)
                {
                     $result = news::where('news_title', 'like', '%'.$lst['news_title'].'%')->where('news_status', 'published')->where('news_price_from', '>=', $lst['min'])->where('news_price_from', '<=', $lst['max'])->where('news_type', 'like', $lst['news_type'])->get();
                }
                if($lst['news_title']  == 4)
                {
                     $result = news::where('news_status', 'published')->where('news_price_from', '>=', $lst['min'])->where('news_price_from', '<=', $lst['max'])->where('news_type', 'like', $lst['news_type'])->get();
                }
                else
                {
                 $result = news::where('news_title', 'like', '%'.$lst['news_title'].'%')->where('news_province', 'like', '%'.$lst['provincials'].'%')->where('news_status', 'published')->where('news_price_from', '>=', $lst['min'])->where('news_price_from', '<=', $lst['max'])->where('news_type', 'like', $lst['news_type'])->get();
                }
                  

            for ($i = 0; $i < count($result); $i++) {



                $result[$i]->news_feature_image  = explode(',', $result[$i]->news_feature_image);



            }



            for ($i = 0; $i < count($result); $i++) {



                $result[$i]->news_image  = explode(',', $result[$i]->news_image);



            }



            for ($i = 0; $i < count($result); $i++) {



                $result[$i]->news_logo  = explode(',', $result[$i]->news_logo);



            }



            for ($i = 0; $i < count($result); $i++) {



                $author = account::where('id', '=', $result[$i]->news_author)->first();



                $result[$i]->news_author = $author;



            }



            return response()->json([



                'status' => true,



                'code' => 200,



                'message'=> trans('message.status_pass'),



                'data' => $result



            ], 200);

                }
        }


        if(count($lst) == 2)
        {
            if (array_key_exists('news_title', $lst) && $lst['news_title'] != null && array_key_exists('provincials', $lst) && $lst['provincials'] != null) {

                 if($lst['provincials']  == 4)
                 {
                    $result = news::where('news_title', 'like', '%'.$lst['news_title'].'%')->where('news_status', 'published')->get();
                 }
                 else 
                 {
                    $result = news::where('news_title', 'like', '%'.$lst['news_title'].'%')->where('news_status', 'published')->where('news_street', 'like', '%'.$lst['provincials'].'%')->limit($limit)->offset($offset)->get();
                 }

            }
            else if (array_key_exists('news_type', $lst) && $lst['news_type'] != null && array_key_exists('provincials', $lst) && $lst['provincials'] != null) {

                if($lst['provincials']  == 4)
                 {
                    $result = news::where('news_type', 'like', $lst['news_type'])->where('news_status', 'published')->get();
                 }
                 else if($lst['news_type'] == 4)
                 {
                    $result = news::where('news_street', 'like', '%'.$lst['provincials'].'%')->where('news_status', 'published')->get();
                 }
                 else
                 {
                $result = news::where('news_status', 'published')->where('news_type', 'like', $lst['news_type'])->where('news_street', 'like', '%'.$lst['provincials'].'%')->limit($limit)->offset($offset)->get();
                }

            }
            else if (array_key_exists('news_type', $lst) && $lst['news_type'] != null && array_key_exists('news_title', $lst) && $lst['news_title'] != null) {

                $result = news::where('news_status', 'published')->where('news_type', 'like', $lst['news_type'])->where('news_title', 'like', '%'.$lst['news_title'].'%')->get();

            }

            for ($i = 0; $i < count($result); $i++) {



                $result[$i]->news_feature_image  = explode(',', $result[$i]->news_feature_image);



            }



            for ($i = 0; $i < count($result); $i++) {



                $result[$i]->news_image  = explode(',', $result[$i]->news_image);



            }



            for ($i = 0; $i < count($result); $i++) {



                $result[$i]->news_logo  = explode(',', $result[$i]->news_logo);



            }



            for ($i = 0; $i < count($result); $i++) {



                $author = account::where('id', '=', $result[$i]->news_author)->first();



                $result[$i]->news_author = $author;



            }



            return response()->json([



                'status' => true,



                'code' => 200,



                'message'=> trans('message.status_pass'),



                'data' => $result



            ], 200);
        }



        if(count($lst) == 1)
        {
            // dd($lst);
            if (array_key_exists('provincials', $lst) && $lst['provincials'] != null) {

                $result = news::where('news_status', 'published')->where('news_street', 'like', '%'.$lst['provincials'].'%')->limit($limit)->offset($offset)->get();

            }


            else if (array_key_exists('news_type', $lst) && $lst['news_type'] != null) {

                $result = news::where('news_status', 'published')->where('news_type', 'like', $lst['news_type'])->limit($limit)->offset($offset)->get();

            }





            else if (array_key_exists('news_title', $lst) && $lst['news_title'] != null) {

                // $result = $result->where('news_status', 'published')->get();
                $result = news::where('news_title', 'like', '%'.$lst['news_title'].'%')->where('news_status', 'published')->get();
            }

            for ($i = 0; $i < count($result); $i++) {



                $result[$i]->news_feature_image  = explode(',', $result[$i]->news_feature_image);



            }



            for ($i = 0; $i < count($result); $i++) {



                $result[$i]->news_image  = explode(',', $result[$i]->news_image);



            }



            for ($i = 0; $i < count($result); $i++) {



                $result[$i]->news_logo  = explode(',', $result[$i]->news_logo);



            }



            for ($i = 0; $i < count($result); $i++) {



                $author = account::where('id', '=', $result[$i]->news_author)->first();



                $result[$i]->news_author = $author;



            }



            return response()->json([



                'status' => true,



                'code' => 200,



                'message'=> trans('message.status_pass'),



                'data' => $result



            ], 200);

         
        }

        // if ((array_key_exists('lowest-price', $lst) && $lst['lowest-price'] != null) && (array_key_exists('highest-price', $lst) && $lst['highest-price'] != null)) {



        //     return response()->json([



        //         'status' => false,



        //         'code' => 401,



        //         'message' => trans('message.input_not_right')



        //     ], 401);



        // }

        


        // // provincials, highest-price



        // if ((array_key_exists('provincials', $lst) && $lst['provincials'] != null) && (array_key_exists('highest-price', $lst) && $lst['highest-price'] != null)) {


        //     $result = $result->where('news_status', 'published')->where('news_street', 'like', '%'.$lst['provincials'].'%')->orderBy('news_price_from', 'desc')->limit($limit)->offset($offset)->get();



        // }



        // // provincials, lowest-price


        // if ((array_key_exists('provincials', $lst) && $lst['provincials'] != null) && (array_key_exists('lowest-price', $lst) && $lst['lowest-price'] != null)) {

        //     $result = $result->where('news_status', 'published')->where('news_street', 'like', '%'.$lst['provincials'].'%')->orderBy('news_price_from')->limit($limit)->offset($offset)->get();



        // }

        // //Tỉttle

        // else if ((array_key_exists('news_title', $lst) && $lst['news_title'] != null) && (array_key_exists('highest-price', $lst) && $lst['highest-price'] != null)) {



        //     $result = $result->where('news_status', 'published')->where('news_title', 'like', '%'.$lst['news_title'].'%')->orderBy('news_price_from', 'desc')->limit($limit)->offset($offset)->get();



        // }

        // else if ((array_key_exists('news_title', $lst) && $lst['news_title'] != null) && (array_key_exists('lowest-price', $lst) && $lst['lowest-price'] != null)) {



        //     $result = $result->where('news_status', 'published')->where('news_title', 'like', '%'.$lst['news_title'].'%')->orderBy('news_price_from')->limit($limit)->offset($offset)->get();



        // }

        // provincials,  news_type



        else if ((array_key_exists('provincials', $lst) && $lst['provincials'] != null) && (array_key_exists('news_type', $lst) && $lst['news_type'] != null)) {

            if($lst['news_type'] == 4)
            {
                $result = $result->where('news_status', 'published')->where('news_street', 'like', '%'.$lst['provincials'].'%')->get();
            }
            else
            {
                $result = $result->where('news_status', 'published')->where('news_street', 'like', '%'.$lst['provincials'].'%')->where('news_type', $lst['news_type'])->get();
            }



        }



        // // Else 



        else {
            
            

            if (array_key_exists('min', $lst) && $lst['min'] != null && array_key_exists('max', $lst) && $lst['max'] != null )
            {
                 if($lst['min'] == $lst['max'])
                {
                    $result =news::where('news_price_from', '>=', $lst['max'])->orderBy('id', 'DESC')->get();
                }
                else
                {
                    $result =news::where('news_price_from', '>=', $lst['min'])->where('news_price_from', '<=', $lst['max'])->orderBy('id', 'DESC')->get();
                }
            }
           

        }



        if (count($lst) == 0) {



            $result = news::orderBy('created_at', 'desc')->limit($limit)->offset($offset)->get();



        }



        for ($i = 0; $i < count($result); $i++) {



            $result[$i]->news_feature_image  = explode(',', $result[$i]->news_feature_image);



        }



        for ($i = 0; $i < count($result); $i++) {



            $result[$i]->news_image  = explode(',', $result[$i]->news_image);



        }



        for ($i = 0; $i < count($result); $i++) {



            $result[$i]->news_logo  = explode(',', $result[$i]->news_logo);



        }



        for ($i = 0; $i < count($result); $i++) {



            $author = account::where('id', '=', $result[$i]->news_author)->first();



            $result[$i]->news_author = $author;



        }



        return response()->json([



            'status' => true,



            'code' => 200,



            'message'=> trans('message.status_pass'),



            'data' => $result



        ], 200);



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



}



