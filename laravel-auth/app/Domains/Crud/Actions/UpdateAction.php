<?php
namespace App\Domains\Crud\Actions;

use Illuminate\Routing\Controller as Action;
use Lumi\Core\Response;
use App\Models as Model;
use App\Domains\Crud\Presenters\Presenter;
use App\Domains\Crud\Transformers\Transformer;
use App\Domains\Crud\Validators\Validator;

class UpdateAction extends Action
{
    public function run($id) {
        $data = \Request::all();

        //validate request
        $validation = Validator::run($data, $id);
        if ( $validation !== true ) {
            return Response::error($validation);
        }

        $data = Transformer::run($data, $id);
        Model\Crud::where('id', $id)->update($data);

        $item = Model\Crud::find($id);
        $item = Presenter::run($item);

        return Response::success(compact('item'));
    }
}
