<?php
namespace App\Domains\Crud\Actions;

use Illuminate\Routing\Controller as Action;
use Lumi\Core\Response;
use App\Models as Model;
use App\Domains\Crud\Presenters\ListPresenter;
use App\Domains\Crud\Filters\Filter;

class ListAction extends Action
{
    public function run() {
        //get query
        $query = Model\Crud::with('domain:id,url');

        //apply filters
        $filters = \Request::all();
        $filters['order_by'] = $filters['order_by'] ?? 'value';
        $filters['order'] = $filters['order'] ?? 'asc';
        Filter::apply($query, $filters);

        //paginate
        $per_page = \Request::get('per_page') ?: config('settings.data_table_per_page');
        $paginated = $query->paginate($per_page);
        $items = ListPresenter::run($paginated->items());
        $total = $paginated->total();
        $pages = $paginated->lastPage();

        return Response::success(compact('items', 'total', 'pages'));
    }
}
