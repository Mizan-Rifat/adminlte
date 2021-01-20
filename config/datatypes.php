<?php

return [
    'users'=>[
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
                'label'=>'Email',
                'column'=>'email',
                'field'=>'email',
                'edit_field'=>'email',
                'type'=>'text',
                "indexShow"=>true,
            ],
            [
                'label'=>'Roles',
                'column'=>'roles',
                'field'=>'roles',
                'edit_field'=>'roles',
                'type'=>'relationship-multi-select',
                'relationship_field'=>'display_name',
                "indexShow"=>true,
                
            ],

            [   
                'label'=>'Avatar',
                'column'=>'avatar',
                'field'=>'avatar',
                'edit_field'=>null,
                'type'=>'image',
                "indexShow"=>true,
            ],
            [   
                'label'=>'Password',
                'column'=>'password',
                'field'=>'password',
                'edit_field'=>'password',
                'type'=>'password',
                "indexShow"=>false,
            ],
            [   
                'label'=>'Confirm Password',
                'column'=>'password_confirmation',
                'field'=>'password',
                'edit_field'=>'password',
                'type'=>'password',
                "indexShow"=>false,
            ],
        ],
    ],
    
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


    'categories'=>[
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
            
        ],
    ],

    'ingredients'=>[
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
            
        ],
    ],

    'addableItems'=>[
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
                'label'=>'Image',
                'column'=>'image',
                'field'=>'image',
                'edit_field'=>'image',
                'type'=>'image',
                "indexShow"=>true,
            ],
            [
                'label'=>'Price',
                'column'=>'price',
                'field'=>'formatted_price',
                'edit_field'=>'price',
                'type'=>'text',
                "indexShow"=>true,
            ],
            
        ],
    ],

    'nutritionalItems'=>[
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
            
        ],
    ],

];