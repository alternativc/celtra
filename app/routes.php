<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home');
});

Route::get('/adds/{add_id?}', function($add_id=null){
    $json_array = array();

    if ($add_id != null){
        $adds = DB::table('adds')->join('categories', 'categories.id', '=', 'category_id')->where('adds.id', '=', $add_id)->get();
    }else{
        $adds = DB::table('adds')->join('categories', 'categories.id', '=', 'category_id')->orderBy('categories.category_name')->get();
    }

    foreach ($adds as $add){
        $json_array[$add->category_name][] = array(
            'name' => $add->add_name,
            'url' => $add->add
        );
    }

    return Response::json($json_array);
});

Route::post('/adds', function(){

    $rules = array(
        'category' => 'required|alpha_num',
        'add_name' => 'required|alpha_num',
        'add_url' => 'required|url'
    );

    $validator = Validator::make(
        Input::all(),
        $rules
    );

    if($validator->fails()){
        // handle error
        return 'error';
    }else{
        $category = Category::where('category_name', '=', Input::get('category'))->first();

        if(count($category) == 0){
            //new category
            $category = new Category();
            $category->category_name = Input::get('category');
            $category->save();
        }
        //get category id

        $category_id = $category->id;

        $add = new Add();
        $add->add_name =  Input::get('add_name');
        $add->add = Input::get('add_url');
        $add->category_id = $category_id;
        $add->save();

        return Redirect::to('/');
    }

});

Route::put('/adds/{add_id}', function($add_id){
    $add = Add::find($add_id);
    if(count($add)>0){
        $rules = array(
            'category' => 'required|alpha_num',
            'add_name' => 'required|alpha_num',
            'add_url' => 'required|url'
        );

        $validator = Validator::make(
            Input::all(),
            $rules
        );

        if($validator->fails()){
            // handle error
        }else{
            $category = Category::where('category_name', '=', Input::get('category'))->first();
            if(count($category) == 0){
                //new category
                $category = new Category();
                $category->category_name = Input::get('category');
                $category->save();
            }
            //get category id
            $category_id = $category->id;

            $add->add_name = Input::get('add_name');
            $add->add_url = Input::get('add_url');
            $add->categroy_id = $category_id;
            $add->save();
            return Redirect::to('/');
        }

    }else{
        //error
        return Redirect::to('/');
    }

});

Route::delete('/adds/{add_id}', function($add_id){
    $add = Add::find($add_id);
    $add->delete();
    return Redirect::to('/');
});