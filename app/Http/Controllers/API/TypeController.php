<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Image;
use Illuminate\Support\Str;
use App\Traits\UtilityTrait;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    use UtilityTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $types = Type::paginate($this->getLimit($request->limit));
        return TypeResource::collection($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {
        $slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);

        $type = $request->except(['image']);
        $type['slug'] = $slug;

        $type = Type::create($type);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/types'), $imageName);

        $image = new Image();
        $image->image = 'images/types/' . $imageName;
        $image->imageable_id = $type->id;
        $image->imageable_type = 'App\Models\Type';
        $image->save();

        if ($type) {
            return new TypeResource($type);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $type = Type::where('slug', $slug)->first();
            $type->views = $type->views + 1;
            $type->save();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Not Found'
            ], 400);
        }

        return new TypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, $slug)
    {
        $new_slug = str_replace(' ', '_', strtolower($request->name_uz)) . '-' . Str::random(5);

        $type = Type::where('slug', $slug)->first();

        $type->name_uz = $request->name_uz;
        $type->name_ru = $request->name_ru;
        $type->name_en = $request->name_en;
        $type->category_id = $request->category_id;
        $type->slug = $new_slug;
        $result = $type->save();

        if ($request->image) {
            $this->deleteImages($type->images);
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/types'), $imageName);

            $image = new Image();
            $image->image = 'images/types/'.$imageName;
            $image->imageable_id = $type->id;
            $image->imageable_type = 'App\Models\Type';
            $image->save();
        }

        if ($result) {
            return response()->json(new TypeResource($type->refresh()), 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $type = Type::where('slug', $slug)->first();

        $this->deleteImages($type->images);

        $this->setNullToArtistId($type->products);

        $result =  $type->delete();

        if ($result) {
            return response()->json([
                'message' => 'Deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }
}
