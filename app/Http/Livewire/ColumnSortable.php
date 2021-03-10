<?php

namespace App\Http\Livewire;

trait ColumnSortable
{
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     *  Method to set column and sort order
     */
    public function sortBy($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortAscending = ! $this->sortAscending;
        } else {
            $this->sortAscending = true;
        }
        
        $this->sortColumn = $column;
    }

}