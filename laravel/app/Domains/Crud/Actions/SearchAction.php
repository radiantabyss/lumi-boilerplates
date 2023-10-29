<?php
namespace App\Domains\Crud\Actions;

use Illuminate\Routing\Controller as Action;
use Lumi\Core\Response;
use App\Models as Model;

class SearchAction extends Action
{
    public function run() {
        $data = \Request::all();

        $items = Model\Crud::where(function($query) use($data) {
                if ( isset($data['id']) && is_numeric($data['id']) ) {
                    $query->where('id', $data['id']);
                }
                else {
                    $query->where('id', $data['term'])
                        ->orWhere('name', 'LIKE', '%'.$data['term'].'%');
                }
            })
            ->limit($data['limit'])
            ->get();

        $items = $items->map(function($item) {
            return [
                'text' => $item->name,
                'value' => $item->id,
            ];
        });

        return Response::success(compact('items'));
    }
}
