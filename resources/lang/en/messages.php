<?php
return [
    'welcome' => 'Welcome to Website!',
    'user' => [
        'email_require' => 'email is required',
        'password_require' => 'password is required',
        'role_require' => 'role is required',
    ],
    'category' => [
        'name' => 'Category',
        'label' => [
            'name' => 'Name',
            'parent' => 'Parent category',
            'description' => 'Description',
            'create' => 'Create category',
            'edit' => 'Edit category',
            'list' => 'List category'
        ],
        'validate' => [
            'name_required' => 'Name is required'
        ]
    ],
    'post' => [
        'name' => 'Post',
        'label' => [
            'title' => 'Title',
            'thumbnail' => 'Thumnail',
            'category' => 'Category',
            'content' => 'Content',
            'create' => 'Create post',
            'edit' => 'Edit post',
            'list' => 'List post'
        ],
        'validate' => [
            'title_required' => 'Title is required',
            'category_required' => 'Category is required',
            'thumbnail_required' => 'Thumbnail is required',
            'thumbnail_image' => 'Thumbnail must be an image'
        ]
    ],
    'gallery' => 'Gallery',
    'options' => 'Options',
    'created_by' => 'Created by'
];