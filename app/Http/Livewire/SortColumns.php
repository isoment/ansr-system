<?php

namespace App\Http\Livewire;

trait SortColumns
{
    public function upDatingSearch()
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