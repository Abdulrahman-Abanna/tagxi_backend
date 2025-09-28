<?php

namespace App\Base\Filters\Admin;

use App\Base\Libraries\QueryFilter\FilterContract;

class AdminFilter implements FilterContract
{
    public function filters()
    {
        return [
            'name',
            'transport_type',
            'status', // Added 'status' filter
            'search',
            'service_location_id'
        ];
    }

    public function defaultSort()
    {
        return '-created_at';
    }

    public function name($builder, $value = null)
    {
        if ($value) {
            $builder->where('name', 'LIKE', '%' . $value . '%');
        }
    }
    public function transport_type($builder, $value = null)
    {
        if ($value) {
            $builder->where('transport_type', 'LIKE', '%' . $value . '%');
        }
    }

    public function status($builder, $value = null)
    {
        if ($value === '1') {
            $builder->where('active', true); // Active records
        } else{
            $builder->where('active', false); // Inactive records
        }
    }
    public function service_location_id($builder,$value="all")
    {
        if($value !== "all"){
            $builder->where('service_location_id',$value)->whereIn('service_location_id',get_user_location_ids(auth()->user()));
        }
    }

    public function search($builder, $value=null) {
        $builder->where('first_name','LIKE','%'.$value.'%');    
    }
}
