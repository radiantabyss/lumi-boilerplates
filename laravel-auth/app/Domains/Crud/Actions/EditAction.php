<?php
namespace App\Domains\Crud\Actions;

use Illuminate\Routing\Controller as Action;
use Lumi\Core\Response;
use App\Models as Model;
use App\Domains\Crud\Presenters\EditPresenter;

class EditAction extends Action
{
    public function run($id) {
        $item = Model\Crud::find($id);

        if ( !$item ) {
            return Response::error(\Domain::name().' not found.');
        }

        $item = EditPresenter::run($item);

        return Response::success(compact('item'));
    }
}
