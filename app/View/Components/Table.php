<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    protected $tables;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dataTables)
    {
        //dd($dataTables);
        $this->tables = array();
        if(is_array($dataTables) && !empty($dataTables)){
            foreach ($dataTables as $table){
                array_push($this->tables, $table);
            }
        } else {
            return false;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.table')
            ->with([
                'tables' => $this->tables,
            ]);;
    }
}
