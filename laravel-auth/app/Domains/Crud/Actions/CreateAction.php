<?php
namespace App\Domains\Crud\Actions;

use Illuminate\Routing\Controller as Action;
use Lumi\Core\Response;
use App\Models as Model;
use App\Domains\Crud\Presenters\Presenter;
use App\Domains\Crud\Transformers\Transformer;
use App\Domains\Crud\Validators\Validator;

class CreateAction extends Action
{
    public function run() {
        $data = \Request::all();

        $validation = Validator::run($data);
        if ( $validation !== true ) {
            return Response::error($validation);
        }

        $data = Transformer::run($data);
        $item = Model\Crud::create($data);
        $item = Presenter::run($item);

        return Response::success(compact('item'));
    }
}
