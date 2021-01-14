<?php

return [
    
    'roles'=>[
        'nextBtn'=>false,
        'fields'=>[
            [
                'label'=>'Name',
                'column'=>'name',
                'field'=>'name',
                'edit_field'=>'name',
                'type'=>'text',
                "indexShow"=>true,
            ],
            [
                'label'=>'Display Name',
                'column'=>'display_name',
                'field'=>'display_name',
                'edit_field'=>'display_name',
                'type'=>'text',
                "indexShow"=>true,
            ],
            
        ],
    ],

    'permissions'=>[
        'nextBtn'=>false,
        'fields'=>[
            [
                'label'=>'Title',
                'column'=>'title',
                'field'=>'title',
                'edit_field'=>'title',
                'type'=>'text',
                "indexShow"=>true,
            ],
            [
                'label'=>'Table Name',
                'column'=>'table_name',
                'field'=>'table_name',
                'edit_field'=>'table_name',
                'type'=>'text',
                "indexShow"=>true,
            ],
            
        ],
    ],

];